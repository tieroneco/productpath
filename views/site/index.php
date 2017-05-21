<app-root></app-root>
<?php
    $this->params['site_brand'] = $site_brand;
    $this->registerJsFile('@web/ideas/inline.bundle.js');
    $this->registerJsFile('@web/ideas/polyfills.bundle.js');
    $this->registerJsFile('@web/ideas/vendor.bundle.js');
    $this->registerJsFile('@web/ideas/main.bundle.js');
    
    
  ?>
