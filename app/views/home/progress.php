<?php 
	 include VIEW . 'head.php';
	 include VIEW . 'header.php';
	 $progress = $this->view_data;
?>


<div class="container">

	<h1 class="my-4">Your Progress

  </h1>

    <h4>Total:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->total, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->total, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>1900-1929:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year2, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year2, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>1930:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year3, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year3, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>1940:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year4, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year4, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>1950:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year5, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year5, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>1960:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year6, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year6, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>1970:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year7, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year7, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>1980:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year8, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year8, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>1990:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year9, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year9, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>2000:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year10, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year10, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <h4>2010-Now:</h4>
    <div class="container"> 
        <div class="progress"> 
            <div class="progress-bar" style="width:<?php echo round($progress->year11, PHP_ROUND_HALF_DOWN);?>%;"> 
                <?php echo round($progress->year11, PHP_ROUND_HALF_DOWN);?>% 
            </div> 
        </div> 
    </div>
    <br>
    <br>

<br>

<br>

    </div>
















<?php include VIEW . 'footer.php';?>