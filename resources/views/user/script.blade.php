 <!-- JavaScript Libraries -->
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
 <script src="lib/easing/easing.min.js"></script>
 <script src="lib/owlcarousel/owl.carousel.min.js"></script>

 <!-- Contact Javascript File -->
 <script src="mail/jqBootstrapValidation.min.js"></script>
 <script src="mail/contact.js"></script>

 <!-- Template Javascript -->
 <script src="js/main.js"></script>


 <!------Script to stuck the display in activity area------>

 <script>
    window.onload = function() {
        // Restore scroll position after full load
        const scrollPosition = localStorage.getItem('scrollPosition');
        if (scrollPosition) {
            const {
                top,
                left
            } = JSON.parse(scrollPosition);
            window.scrollTo(left, top);
        }
    };

    // Save scroll position before the page unloads
    window.addEventListener('beforeunload', function() {
        const scrollPosition = {
            top: window.scrollY,
            left: window.scrollX
        };
        localStorage.setItem('scrollPosition', JSON.stringify(scrollPosition));
    });
</script>