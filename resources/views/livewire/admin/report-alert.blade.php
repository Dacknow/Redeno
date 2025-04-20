<div>
    <div class="relative d-flex align-items-center notification-container" wire:poll.15s>
        <!-- Botón de notificaciones -->
        <a href="{{ route('manage-reports') }}" title="Reportes" class="btn notification-btn">
            <i class="icon dw dw-notification {{ $reportCount > 0 ? 'text-danger animate__animated animate__shakeX' : '' }}"></i>

            @if($reportCount > 0)
                <span id="reportCount" class="badgeMe notification-active">
                    {{ $reportCount }}
                </span>
            @endif
        </a>
        
        <!-- Botón de mute/unmute -->
        <button wire:click="toggleMute" class="btn notification-btn">
            @if($isMuted)
                <i class="icon dw dw-mute-1" title="Activar sonido"></i>
            @else
                <i class="icon dw dw-sound" title="Desactivar sonido"></i>
            @endif
        </button>
    </div>

    <button onclick="document.getElementById('reportSound').play()" style="display:none;" id="soundInit">Init</button>
    <audio id="reportSound" src="{{ asset('sounds/report-notification.mp3') }}" preload="auto"></audio>
</div>
@push('scripts')
<script>
    window.addEventListener('play-notification', () => {
        const sound = document.getElementById('reportSound');
        if (sound) {
            sound.play().catch(err => {
                console.error('No se pudo reproducir el sonido:', err);
            });
        }
    });
    window.addEventListener('toggleMute', (isMuted) => {
            const sound = document.getElementById('reportSound');
            if (sound) {
                sound.muted = isMuted;
            }
    });
</script>
@endpush

