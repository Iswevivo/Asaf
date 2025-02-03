<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/x-icon" href="{{ asset('images/asaf.jpg') }}?v={{ time() }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="{{ asset('node_modules/trix/dist/trix.css') }}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.default.css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>

    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <title>Asaf -@yield('title')</title>
</head>

<body>
    <main>
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                    </div>
                    <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex-shrink-0">
                            <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">Logo Asaf</a>
                        </div>
                        <div class="hidden sm:block sm:ml-6">
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">À propos</a>
                                <a href="{{route('programs.index')}}" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Programmes</a>
                                <a href="{{route('events.index')}}" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Evenements</a>
                                <a href="#" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Partenaires</a>
                                <a href="#" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Blog</a>
                                <a href="#" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                            </div>
                        </div>
                    </div>
                    <div class="hidden sm:block">
                        <a href="#" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Faire un don</a>
                        <a href="{{route('dashboard')}}" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="#" class="text-gray-900 hover:bg-gray-200 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Signin</a>
                    </div>
                </div>
            </div>
        </nav>

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
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.tailwindcss.js"></script>
    <script>
        if (document.getElementById("filter-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#filter-table", {
                tableRender: (_data, table, type) => {
                    if (type === "print") {
                        return table
                    }
                    const tHead = table.childNodes[0]
                    const filterHeaders = {
                        nodeName: "TR",
                        attributes: {
                            class: "search-filtering-row"
                        },
                        childNodes: tHead.childNodes[0].childNodes.map(
                            (_th, index) => ({nodeName: "TH",
                                childNodes: [
                                    {
                                        nodeName: "INPUT",
                                        attributes: {
                                            class: "datatable-input",
                                            type: "search",
                                            "data-columns": "[" + index + "]"
                                        }
                                    }
                                ]})
                        )
                    }
                    tHead.childNodes.push(filterHeaders)
                    return table
                }
            });
        }
    </script>
</body>

</html>
