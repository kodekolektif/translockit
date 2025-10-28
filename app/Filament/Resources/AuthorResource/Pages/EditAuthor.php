<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use App\Filament\Resources\AuthorResource;
use Filament\Actions;
use Filament\Forms\Components\Actions as ComponentsActions;
use Filament\Forms\Components\Actions\Action as ComponenetActionsAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditAuthor extends EditRecord
{
    protected static string $resource = AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->before(function ($action, Model $record) {
                // Hapus record sibling (ES) sebelum record utama (EN) dihapus
                $record->sibling()->delete();
                // Hapus file ikon jika ada
                if ($record->profile) {
                    Storage::disk('public')->delete($record->profile);
                }
            }),
        ];
    }
      public function form(Form $form): Form
    {
        // Kode form Anda sebagian besar sudah benar, kita letakkan di sini.
          return $form
            ->schema([
                FileUpload::make('profile') // The name 'icon' MUST match your code
                    ->label('Profle Picture') // Optional: label for the field
                    ->image() // Optional: for image previews and validation
                    ->disk('public') // Tell Filament to use the public disk
                    ->required() // Or ->nullable() if the icon is not required
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->maxLength(255)
                     ->columnSpanFull(),
                Section::make('English (EN)')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.en')
                            ->label('Title (EN)')
                            ->maxLength(255),
                        Textarea::make('description.en')
                            ->label('Content (EN)'),
                    ]),
                    ComponentsActions::make([
                        ComponenetActionsAction::make('Make Spanish Translation')
                            ->action(function (Get $get, Set $set) {
                                $titleEn = $get('title.en');
                                $description = $get('description.en');

                                // Call your Gemini class
                                $translator = new \App\Libs\GeminiAI(app(\App\Settings\AppSettings::class));
                                $titleEs = $translator->translate($titleEn, 'es');
                                $descriptionEs = $translator->translate($description, 'es');

                                // Set translated fields
                                $set('title.es', $titleEs);
                                $set('description.es', $descriptionEs);
                            })
                            ->icon('heroicon-o-language'),
                    ]),
                Section::make('Spanish (es)')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title.es')
                            ->label('Title (ES)')
                            ->maxLength(255),
                        Textarea::make('description.es')
                            ->label('Content (ES)'),
                    ]),
                Section::make('Social Account')
                    ->collapsible()
                    ->schema([
                        TextInput::make('social_instagram')
                            ->label('Instagram')
                            ->url()
                            ->prefix(fn () => 'instagram')
                            ->extraAttributes(['class' => 'pl-10'])
                            ->maxLength(255)
                            ->inlineLabel(false)
                            ->prefixIcon(null),

                        TextInput::make('social_linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->prefix(fn () => 'linkedIn')
                            ->extraAttributes(['class' => 'pl-10'])
                            ->maxLength(255),

                        TextInput::make('social_facebook')
                            ->label('Facebook')
                            ->url()
                            ->prefix(fn () => 'facebook')
                            ->extraAttributes(['class' => 'pl-10'])
                            ->maxLength(255),

                        TextInput::make('social_twitter')
                            ->label('Twitter')
                            ->url()
                            ->prefix(fn () => 'twitter')
                            ->extraAttributes(['class' => 'pl-10'])
                            ->maxLength(255),

                    ]),
            ]);
    }

    /**
     * PERBAIKAN 1: Memuat data dari kedua record (EN & ES) ke dalam form.
     */
    public function mount(int | string $record): void
    {
        parent::mount($record);

        $recordModel = $this->getRecord();
        $sibling = $recordModel->sibling()->first();

        $formData = [
            'profile' => $recordModel->profile,
            'name' => $recordModel->name,
            'title' => [
                'en' => $recordModel->title ?? '',
                'es' => $sibling?->title ?? ''
            ],
            'description'=> [
                'en' => $recordModel->description ?? '',
                'es' => $sibling?->description ?? ''
            ],
            'social_instagram' => $recordModel->social_instagram,
            'social_linkedin' => $recordModel->social_linkedin ?? '',
            'social_facebook'=> $recordModel->social_facebook ?? '',
            'social_twitter'=> $recordModel->social_twitter ?? ''

        ];

        $this->form->fill($formData);
    }

    /**
     * PERBAIKAN 2: Menyimpan data ke kedua record (EN & ES).
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
             $sibling = $record->sibling()->first();

            // Start with the existing logo filename from the record
            $profileFileName = $record->profile;

            // ✅ MODIFIED LOGIC HERE
            // Check if a NEW logo file was actually uploaded
            if (isset($data['profile']) && $data['profile'] instanceof TemporaryUploadedFile) {
                // A new file was uploaded, process it
                if ($record->logo) {
                    // Delete the old logo using its full path
                    Storage::disk('public')->delete( $record->profile);
                }
                $fullPath = $data['profile']->store('public');
                $profileFileName = basename($fullPath);
            } else if (isset($data['profile']) && is_string($data['profile'])) {
                $profileFileName = $data['profile'];
            } else {
                $profileFileName = null; // Or an empty string, depending on your database schema
            }

            // Update record utama (EN)
            $record->update(attributes: [
                'profile'   => $profileFileName,
                'name'   => $data['name'],
                'title'       => $data['title']['en'],
                'description'     => $data['description']['en'],

                'social_instagram' => $data['social_instagram']??'',
                'social_linkedin' => $data['social_linkedin']?? '',
                'social_facebook'=> $data['social_facebook']?? '',
                'social_twitter'=> $data['social_twitter']?? '',
            ]);

            // Update record sibling (ES)
            if ($sibling) {
                $sibling->update([
                    'profile'   => $profileFileName,
                    'name'   => $data['name'],
                    'title'       => $data['title']['es'],
                    'description'     => $data['description']['es'],

                    'social_instagram' => $data['social_instagram']??'',
                    'social_linkedin' => $data['social_linkedin']?? '',
                    'social_facebook'=> $data['social_facebook']?? '',
                    'social_twitter'=> $data['social_twitter']?? '',
                ]);
            }

            return $record;
        });
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
