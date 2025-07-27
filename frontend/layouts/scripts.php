<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
document.querySelectorAll('.add-to-cart').forEach(button => {
  button.addEventListener('click', function(e) {
    e.preventDefault();

    const id = this.dataset.id;
    const name = this.dataset.name;
    const price = this.dataset.price;
    const image = this.dataset.image;

    fetch('/DAY6/frontend/pages/addToCart.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `id=${id}&name=${encodeURIComponent(name)}&price=${price}&image=${encodeURIComponent(image)}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
      
        document.querySelector('.item-count').textContent = data.count;
      }
    });
  });
});
</script>

