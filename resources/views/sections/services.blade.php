<style>
    .modalDescription ul li {
        list-style: disc;
        margin-left: 20px;
        color: #686777;
    }
</style>
<!-- Services Section -->
<div class="main-services black-bg pt-120 pb-90" data-background="assets/img/pattern/pt1.png">
    <div class="container">
        <div class="row mb-60">
            <div class="col-12">
                <div class="sec-wrapper text-center">
                    <h5>{{ __('landing.Services') }}</h5>
                    <h2 class="section-title text-white">{{ __('landing.explore our services') }}</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center text-center">
            @foreach ($services as $service)
                <div class="col-lg-4 col-md-6 col-sm-12 grid-item">
                    <div class="tportfolio mb-30">
                        <div class="tportfolio__img"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                            data-title="{{ $service->name }}"
                            data-description="{{ $service->description }}"
                            data-image="{{ Storage::url($service->image) }}"
                        >
                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}"
                                style="width:100%; height:370px; object-fit:cover;" />
                            <div class="tportfolio__text tportfolio__text-2">
                                <h3 class="tportfolio-title">
                                   {{ $service->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 mb-3 mb-md-0">
            <img src="" alt="Service Image" id="modalImage" style="width:100%; height:370px; object-fit:cover;">
          </div>
          <div class="col-md-6 ">
            <h3 id="modalTitleContent"></h3>
            <div id="modalDescription" class="modalDescription"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script -->
<script>
    const exampleModal = document.getElementById('exampleModal');

    exampleModal.addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;

        const title = trigger.getAttribute('data-title') || '';
        console.log(title)
        const description = trigger.getAttribute('data-description') || '';
        const image = trigger.getAttribute('data-image') || '';

        // Set modal content
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalTitleContent').textContent = title;
        document.getElementById('modalDescription').innerHTML = description;
        document.getElementById('modalImage').setAttribute('src', image);
        document.getElementById('modalImage').setAttribute('alt', title);
    });
</script>
