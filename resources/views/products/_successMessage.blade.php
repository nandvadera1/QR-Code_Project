@if(session()->has('success'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var notification = document.getElementById('notification');
            var notificationText = document.getElementById('notification-text');

            var successMessage = "{{ session('success') }}";
            if (successMessage) {
                notificationText.textContent = successMessage;
                notification.style.display = 'block';

                setTimeout(function () {
                    notification.style.display = 'none';
                }, 4000);
            }
        });
    </script>
@endif
