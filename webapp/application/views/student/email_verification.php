<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual-and-Remote-Guidance-Counselling-System | <?=$heading;?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url().'media/'?>assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="<?=base_url().'media/'?>dist/css/style.min.css" rel="stylesheet">
    <link href="<?=base_url().'media/'?>global.css" rel="stylesheet">
    <style type="text/css">

/*the container must be positioned relative:*/
.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element:*/
}

.select-selected {
  background-color: #ffffff;
}

/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #3e5569 transparent transparent transparent;
}

/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #3e5569;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
  border-radius: 10px;
}

/*style items (options):*/
.select-items {
  position: absolute;
  background-color: #ffffff;
  border-radius: 10px;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}
    </style>
</head>

<body class="login">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
            <div class="container-fluid" style="margin-top:100px;">
                
                <!-- Row -->

<div class="row justify-content-md-center align-items-center" style=" min-height: 500px !important;">
    <!-- column -->
    <div class="col-3">
        <div class="card">
            <div class="card-body text-center">
                <h2 class="card-title">Welcome!</h2>
                <p>Thanks for signing up! We just need you to verify your email address to complete setting up your account.</p>
                <form class="form-horizontal form-material mx-2" action="<?=site_url().'student/student_verify/'.$this->uri->segment(3);?>" method="post">
                    <?=$this->routines->InsertCSRF()?>
                    <button class="btn btn-success text-white" style="width: 200px; background: #5271ff;" type="submit">Verify My Email</button>
                </form>
            </div>
        </div>
    </div>
</div>
            </div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?=base_url().'media/'?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=base_url().'media/'?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url().'media/'?>dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="<?=base_url().'media/'?>dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url().'media/'?>dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url().'media/'?>dist/js/custom.js"></script>
    <script type="text/javascript">
        function successful() {
           // $('#alertsuccess').removeClass('d-none');
           //  setTimeout(function(){
           //     $('#alertsuccess').addClass('d-none');
           //  }, 5000);
            document.querySelector('#alertsuccess').classList.remove('d-none');
            setTimeout(function(){
               document.querySelector('#alertsuccess').classList.add('d-none');
            }, 5000);
        }
        function failed() {
           // $('#alertsuccess').removeClass('d-none');
           //  setTimeout(function(){
           //     $('#alertsuccess').addClass('d-none');
           //  }, 5000);
            document.querySelector('#alertdanger').classList.remove('d-none');
            setTimeout(function(){
               document.querySelector('#alertdanger').classList.add('d-none');
            }, 5000);
        }
    </script>

    <?php if($this->session->flashdata('Success') != '') : ?>
        <script>
        successful();
        </script>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('Failed') != '') : ?>
        <script>
        failed();
        </script>
    <?php endif; ?>

<script type="text/javascript">
var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);
</script>
</body>

</html>
