<div class="accordion" id="{{ $accordionId }}">
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{ $id }}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $id }}"
                aria-expanded="{{ $expanded ?? 'false' }}" aria-controls="{{ $id }}">
                {{ $title }}
            </button>
        </h2>
        <div id="{{ $id }}" class="accordion-collapse collapse {{ $show ?? '' }}" aria-labelledby="heading{{ $id }}" data-bs-parent="#{{ $accordionId }}">
            <div class="accordion-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

