<div class="w-10/12  justify-center">
    @if (session()->has('error'))
        <div id="alert-border-2" x-data="{ shown: true, timeout: null }" x-init="timeout = setTimeout(() => { shown = false }, 3000)" x-show.transition.out.opacity.duration.500ms="shown"
            style="display: none;"  >

            <div class="p-4 mb-4 text-sm font-semibold text-red-800 text-center rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                {{ session('error') }}
              </div>
        </div>
    @endif
    <div class=" min-h-screen">
        <!-- Hero Section -->
        <section class="bg-blue-600 text-white py-4">
            <div class="container mx-auto text-center">
                <h1 class="text-3xl font-bold mb-2">Апликативни софтвер "ДокОрг"</h1>
                <p class="text-lg">за помоћ израде предлога организацијско-мобилизацијских промена (ОМП)</p>
            </div>
        </section>

        <!-- Short Information Section -->
        <section class="py-6 bg-gray-100">
            <div class="container mx-auto">
                {{-- <h2 class="text-2xl font-bold text-center mb-8">О програму</h2> --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Card 1 -->
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Циљ</h3>
                        <p class="text-gray-600 ">
                            Повећање ефикасности и продуктивности организације код израде и контроле предлога за ОМП
                        </p>
                    </div>
                    <!-- Card 2 -->
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Намена</h3>
                        <p class="text-gray-600 ">
                            Намењен за пружање подршке покретачима иницијативе ОМП,
                            носиоцима планирања промена и осталима који раде на пословима организације
                        </p>
                    </div>
                    <!-- Card 1 -->
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Документа</h3>
                        <p class="text-gray-600 ">
                            ДокОрг користи искључиво податке прописа који су из надлежности Управе за организацију
                        </p>
                    </div>
                    <!-- Card 2 -->
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Израда</h3>
                        <p class="text-gray-600 ">
                            Израђен у Управи за организацију, сопственим ресурсима
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->

        <footer class="bg-white">
            <hr>
            <div class="mx-auto w-full max-w-screen-xl p-2 py-4 lg:py-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-2 md:mb-0">
                        {{-- <a href="https://flowbite.com/" class="flex items-center"> --}}
                            {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3"
                                alt="FlowBite Logo" /> --}}
                            <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-600">Управа за
                                организацију</span>
                            {{-- </a> --}}
                    </div>
                    <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                        <div>
                            <h2 class="mb-1 text-sm font-semibold text-gray-900 uppercase dark:text-white">Адреса</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-2">
                                    Бирчанинова 5
                                </li>

                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-1 text-sm font-semibold text-gray-900 uppercase dark:text-white">Телефон</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-2">
                                    23-058
                                </li>

                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-1 text-sm font-semibold text-gray-900 uppercase dark:text-white">Рамко</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-2">
                                    <a href="#" class="hover:underline">kancelarija@uo.sljr.mo</a>
                                </li>

                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-1 text-sm font-semibold text-gray-900 uppercase dark:text-white">Израдио</h2>
                            <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                <li class="mb-2">
                                    <a href="#" class="hover:underline">bojan.djordjevic@uo.sljr.mo</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-4 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a
                            href="bojan.djordjevic@uo.sljr.mo" class="hover:underline">Uprava za organizaciju</a>.
                    </span>

                </div>
            </div>
    </div>
    </footer>







</div>