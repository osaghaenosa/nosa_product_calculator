<section style="position: fixed; left:0px;top:0px; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display:flex; flex-direction: column; align-items: center; justify-content: center">
    <div class="rounded bg-white text-dark" style=" width:400px; overflow: hidden">
        <h1 class="text-center w-100 bg-success text-white px-4 py-2">Transaction History</h1>
        <div class="py-3 px-3">
            <form method="post" action="">
                
                <div class="d-flex flex-row-reverse justify-content-between">
                    
                    <a <?php echo "href='?r=home&users=".$_GET["users"]."'"; ?> class="btn btn-dark btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
<style>
    body{
        overflow-y: hidden;
        height:100vh;
    }
</style>