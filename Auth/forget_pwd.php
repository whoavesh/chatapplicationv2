

<form action="../php/process_forgot_password.php" method="POST" enctype="multipart/form-data" autocomplete="on" class="form login mx-auto mt-8 mb-0 max-w-md space-y-4">
    <div>
      <label for="email" class="sr-only">Enter your email:</label>

      <div class="relative field input">
        <input
          type="email" name="email" id="email"
          class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
          placeholder="Enter email"
          required
        />
        <span class="absolute inset-y-0 right-4 inline-flex items-center">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-gray-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
            />
          </svg>
        </span>
       
</div>
<div class="flex items-center justify-between">
    <button
            type="submit"
            class="field button  rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white">
            Reset
          </button>



</div>
</form>