<nav class="bg-white border-b py-2">
    <div class="container mx-auto flex gap-1 px-2 justify-between">
        <div class="flex justify-between items-center">
            <div class="ff-edu-nsw-act-foundation">
                <a href="{{ route(constant('HOME')) }}">
                    <img class="w-20" src="{{ asset('img/logo.png') }}" alt="logo">
                </a>
            </div>
            <button class="btn btn-dark hidden" type="button" data-dropdown-toggle="navbar-links">
                <span class="icon-container">
                    <i class="fa-solid fa-bars"></i>
                </span>
            </button>
        </div>
        <div class="overflow-hidden max-h-max block duration-200" data-animation-direction="from-top" id="navbar-links">
            <div class="navbar-end ms-auto">
                <div class="navbar-item">
                    <div class="control m-0">
                        <a target="_blank" href="https://github.com/AdrianY1997/foxy-mvc">
                            <button class="btn btn-dark">
                                <span class="icon-container">
                                    <i class="fa-brands fa-github"></i> GitHub
                                </span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>