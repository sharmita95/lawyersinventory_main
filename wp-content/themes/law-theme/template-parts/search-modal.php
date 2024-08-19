<div id="myModal" class="h-full bg-white" style="width:100% !important; display:none">
    <div class="modal-content">
        <div class="container mx-auto flex flex-col">
            <div class="toggle-cut text-2xl ">
                <span onclick="document.getElementById('myModal').style.display='none'" class="close cursor-pointer">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="#101010" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.5652 14.0234L27.4679 3.12039C28.1774 2.41119 28.1774 1.26453 27.4679 0.555333C26.7587 -0.153861 25.612 -0.153861 24.9028 0.555333L13.9998 11.4583L3.0972 0.555333C2.38767 -0.153861 1.24134 -0.153861 0.532144 0.555333C-0.177381 1.26453 -0.177381 2.41119 0.532144 3.12039L11.4348 14.0234L0.532144 24.9263C-0.177381 25.6355 -0.177381 26.7822 0.532144 27.4914C0.885578 27.8452 1.35029 28.0229 1.81467 28.0229C2.27905 28.0229 2.74343 27.8452 3.0972 27.4914L13.9998 16.5884L24.9028 27.4914C25.2566 27.8452 25.721 28.0229 26.1853 28.0229C26.6497 28.0229 27.1141 27.8452 27.4679 27.4914C28.1774 26.7822 28.1774 25.6355 27.4679 24.9263L16.5652 14.0234Z" fill="" />
                    </svg>
                </span>
            </div>
            <div class="mx-auto w-full max-w-[78rem] mt-[calc(1rem+3vmin)]">
                <div class="input-sec">
                    <input type="search" name="s" id="default-search" class="search-input-field" placeholder="TYPE TO SEARCH...." required="">
                    <div class="search-svg">

                    </div>
                </div>

                <div class="modal-body">
                    <?php
                    for ($latest_card = 0; $latest_card <= 2; $latest_card++) {
                        echo  get_template_part('template-parts/Blog', 'card');
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>