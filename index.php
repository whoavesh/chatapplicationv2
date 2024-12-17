<?php include_once "header.php"; ?>
<section class="bg-gray-900 bg-[url('php/images/hero-pattern-dark.svg')]" style="height:100vh";>
    <div class="px-4 mx-auto max-w-screen-xl z-10 relative">

        <nav class="px-2 py-4 w-full z-20 sticky top-0 left-0">
            <div class="container flex flex-wrap items-center justify-between mx-auto">
                <a href="index.php" class="flex items-center">
                    <h1 style="color:White; font-size:3vh;">ChatApp
                    </h1 ><!-- <img src="php/images/sendbox_logo_white.svg" class="h-6 mr-3 sm:h-9" alt="SendBox Logo"> -->
                </a>
                <div class="flex md:order-2">
                    <a href="Auth/auth.php?auth=login">
                        <button type="button" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 drop-shadow-lg">Login</button>
                    </a>
                    <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                    <ul class="flex flex-col p-4 mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium bg-blue-900 rounded-2xl drop-shadow-lg">
                        <li>
                            <a href="/sendbox" class="block py-2 pl-3 pr-4 text-white md:p-0 hover:text-gray-300" aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="../about-us.php" class="block py-2 pl-3 pr-4 text-white md:p-0 hover:text-gray-300">About</a>
                        </li>
                        <li>
                            <a href="../service.php" class="block py-2 pl-3 pr-4 text-white md:p-0 hover:text-gray-300">Services</a>
                        </li>
                        <li>
                            <a href="../contact-us.php" class="block py-2 pl-3 pr-4 text-white md:p-0 hover:text-gray-300">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

      
        <div class="overflow-hidden py-5">
            <div class="px-4 py-6 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8" style="padding-top:25vh">
                <div class="flex flex-col items-center justify-between xl:flex-row">
                    <div class="w-full max-w-xl mb-12 xl:pr-16 xl:mb-0 xl:w-7/12">
                        <!-- <p class="inline-block px-3 py-px mb-4 text-xs font-semibold tracking-wider text-teal-900 uppercase rounded-full bg-teal-400">
                            Alpha
                        </p> -->
                        <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-gray-100 sm:text-4xl sm:leading-none">
                            Welcome to<br class="hidden md:block" />
                            <span class="inline-block text-cyan-500">ChatApp</span>
                        </h2>
                        <p class="text-base text-gray-400 md:text-lg">
                            A place where every converstaion matters
                        </p>

                    </div>
                    <div class="px-5 pt-6 pb-5 text-center border border-gray-300 rounded lg:w-2/5">
                        <div class="mb-5 font-semibold text-white">Create an account</div>
                    
                        <p class="max-w-md px-5 mb-3 text-xs text-gray-300 sm:text-sm md:mb-5">
                            Not have any account? Simply register and Quickly Access your Chat.
                        </p>
                        <a href="Auth/auth.php?auth=signup" class="inline-flex items-center justify-center w-full h-12 px-6 font-semibold transition duration-200 bg-white border border-gray-300 rounded md:w-auto hover:bg-gray-100 focus:shadow-outline focus:outline-none">
                            Sign Up with Email
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>

</body>

</html>