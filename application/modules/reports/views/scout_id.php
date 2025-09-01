<div class="page-content">     
  <div class="content">  
    <ul class="breadcrumb" style="margin-bottom: 20px;">
      <li> <a href="<?=base_url()?>" class="active"> Dashboard </a> </li>
      <li> <a href="<?=base_url()?>" class="active"> <?=$module_title; ?> </a></li>
      <li><?=$meta_title; ?> </li>
    </ul>

    <div class="row-fluid">
      <div class="span12">
        <div class="grid simple ">
          <div class="grid-title">
            <h4><span class="semi-bold"><?=$meta_title; ?></span></h4>           
          </div>

          <div class="grid-body ">

          <pre>
            <?php 
            // echo sprintf("%04d", 1); echo '<br>';
            // var_dump($output);
            echo count($output); echo '<br>';

              foreach ($output as $value) {
                //echo $value; //exit;
                  $char = mb_substr($value, 0,2);// exit;
                  $number = substr($value, 2);
                  echo $char . sprintf("%04d", $number); echo '<br>';
              }

            ?>
            </pre>
          </div>
        </div>
      </div>
    </div>

    </div> <!-- END ROW -->

  </div>
</div>