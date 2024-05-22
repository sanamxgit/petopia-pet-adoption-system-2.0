function showOverlay(message) {
    var overlay = document.getElementById('overlay');
    var overlayContent = document.getElementById('overlayContent');
    overlayContent.innerHTML = message;
    overlay.classList.remove('hidden');
    setTimeout(function() {
        overlay.classList.add('hidden');
    }, 3000); // Hide after 3 seconds
}
      document.getElementById('registerBtn').addEventListener('click', function() {
    document.getElementById('registerForm').classList.toggle('hidden');
});