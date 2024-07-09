<footer class="bg-white border-t ">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="https://jjcgeneralstore.online/" class="flex items-center">
                  <img src="{{ asset('logo.png') }}" class="h-8 me-3" alt="IMAGE" />
                  <span class="self-center text-2xl font-semibold whitespace-nowrap ">JJC GENERAL STORE

                  </span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Links</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="/" class="hover:underline">Home</a>
                      </li>
                      <li class="mb-4">
                          <a href="/Product" class="hover:underline">Products</a>
                      </li>
                      <li>
                        <a href="/Contact" class="hover:underline">Contact Us</a>
                    </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Follow us</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="https://www.facebook.com/jjc.genmdsg" target="_blank" class="hover:underline ">Facebook</a>
                      </li>
                      <li>
                          <a href="https://www.instagram.com/sipolgin/" target="_blank" class="hover:underline">Instagram</a>
                      </li>
                  </ul>
              </div>
              <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Others</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    <li class="mb-4">
                        <a href="{{ route('term.condition') }}"  class="hover:underline ">Terms and Conditions</a>
                    </li>

                </ul>
            </div>
              {{-- <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Legal</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline">Privacy Policy</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                      </li>
                  </ul>
              </div> --}}
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto  lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center ">© 2024 <a href="/" class="hover:underline">JJC</a>. All Rights Reserved.
          </span>

      </div>
    </div>
</footer>
