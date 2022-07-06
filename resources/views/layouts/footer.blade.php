<footer class="w-full relative bottom-0 h-auto">
    <div class="container h-2/5">
        <div class="flex justify-between mb-2">
            <div class="w-1/2"></div>
            <div class="w-1/2 flex flex-row-reverse">
                @if(isset($back))
                    <return-button route="{{ $back }}">
                        <arrow-left></arrow-left>
                    </return-button>
                @endif
            </div>
        </div>
    </div>
    <div class="sub-footer w-100 h-3/5">
        <div class="flex justify-center h-100 items-center">
            <span class="text-md">
                &copy;MitrofanovVI
            </span>
        </div>
    </div>
</footer>



