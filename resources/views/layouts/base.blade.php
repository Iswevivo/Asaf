<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('images/asaf.jpg') }}?v={{ time() }}">
    <!-- Dans layouts/base.blade.php -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="{{ asset('node_modules/trix/dist/trix.css') }}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.default.css">

    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <title>Asaf -@yield('title')</title>
</head>

<body>
    <main>
        <div class="min-h-screen p-6 bg-gray-100">
            <div class="container mx-auto">
                @yield('content')
            </div>
        </div>
        @yield('footer')
    </main>

    <script src="{{ asset('node_modules/trix/dist/trix.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        const carouselSlide = document.querySelector('.carousel-slide');
        const carouselItems = document.querySelectorAll('.carousel-item');
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');

        let currentIndex = 0;

        function showSlide(index) {
            if (index < 0) {
                currentIndex = carouselItems.length - 1;
            } else if (index >= carouselItems.length) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }
            const offset = -currentIndex * 100;
            carouselSlide.style.transform = `translateX(${offset}%)`;
        }

        prevButton.addEventListener('click', () => {
            showSlide(currentIndex - 1);
        });

        nextButton.addEventListener('click', () => {
            showSlide(currentIndex + 1);
        });

        showSlide(currentIndex); // Affiche la première image au chargement
    </script>
    <script>
        document.querySelectorAll('.carousel-container').forEach((carousel, index) => {
            const slide = carousel.querySelector('.carousel-slide');
            const items = carousel.querySelectorAll('.carousel-item');
            const prevButton = carousel.querySelector('.prev');
            const nextButton = carousel.querySelector('.next');

            let currentIndex = 0;

            function showSlide(i) {
                if (i < 0) {
                    currentIndex = items.length - 1;
                } else if (i >= items.length) {
                    currentIndex = 0;
                } else {
                    currentIndex = i;
                }
                const offset = -currentIndex * 100;
                slide.style.transform = `translateX(${offset}%)`;
            }

            prevButton.addEventListener('click', () => {
                showSlide(currentIndex - 1);
            });

            nextButton.addEventListener('click', () => {
                showSlide(currentIndex + 1);
            });

            showSlide(currentIndex);
        });
    </script>
    <script>
        new TomSelect('select[multiple]', {'plugins' : {'remove_button' : {'title' : 'Retirer le tag'} }})
    </script>
</body>

</html>
