<div {{ isset($id) ? 'id='.$id : '' }} class="animatedModal animated container" tabindex="1" {{ isset($ngController) ? 'ng-controller='.$ngController : '' }}>

    <header class="animatedModal-header row">
        {{ isset($header_content) ? $header_content : '' }}
    </header>

    <section class="animatedModal-content row {{ !isset($content_classes) ?: $content_classes }}">
        {{ $slot }}
    </section>

    @if(isset($footer))
        <footer class="animatedModal-footer row">{{ $footer }}</footer>
    @endif

</div>

@if(isset($withOverlay) && $withOverlay)
    <div id="{{ $id }}-overlay" class="animatedModal-overlay"></div>
@endif
