<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="description" content="">
   <meta name="author" content="">
   <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
   <title>Screen</title>
   <link rel="stylesheet" href="{{ asset('layout/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('layout/css/style.css') }}">
</head>
<body>
   <section>
    <?php 
        // Silver Left
        $sa = array('5','4','3','2','1');
        $sb = array('15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sc = array('16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sd = array('17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $se = array('17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sf = array('17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sg = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sh = array('20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $si = array('18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sj = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sk = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sl = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sm = array('13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sn = array('13','12','11','10','9','8','7','6','5','4','3','2','1');

        // VIP & Gold
        $vip_a = array('16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_a_right = array('16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_b = array('17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_b_right = array('17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_c = array('18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_c_right = array('18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_d = array('18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_d_right = array('18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_e = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_e_right = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_f = array('20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_f_right = array('20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_g = array('21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_g_right = array('21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_h = array('21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_h_right = array('21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_i = array('22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_i_right = array('22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_j = array('23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_j_right = array('23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_k = array('24','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_k_right = array('24','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_l = array('24','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_l_right = array('24','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_m = array('24','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_m_right = array('24','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_n = array('24','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_n_right = array('7','6','5','4','3','2','1');
        $vip_o = array('24','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $vip_o_right = array('5','4','3','2','1');

        // Silver Right
        $sra = array('5','4','3','2','1');
        $srb = array('15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $src = array('16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $srd = array('17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sre = array('17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $srf = array('17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $srg = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $srh = array('20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $sri = array('18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $srj = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $srk = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $srl = array('19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1');
        $srm = array('13','12','11','10','9','8','7','6','5','4','3','2','1');
        $srn = array('13','12','11','10','9','8','7','6','5','4','3','2','1');
    ?>
      <div class="container-fluid custom-container">
        <div class="logo-sec">
         <img src="{{ asset('layout/images/logo.svg') }}" class="logo"/>
         </div>
         <img src="{{ asset('layout/images/stage.png') }}" class="stage" />
         <img src="{{ asset('layout/images/stage-mobile.png') }}" class="stage-mobile" />
         <div class="row">
            <div class="col-md-3 col-3">
               <div class="silver-sec">
                  <h1 class="text-center">SILVER</h1>
                  <!-- A Silver -->
                  <div class="A silver">
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p style="color:#212529">A</p>
                          </li>
                       @foreach($sa as $a)
                       <li class="seat">
                         <input type="checkbox" id="SA{{$a}}" />
                         <label for="SA{{$a}}">{{$a}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- B Silver -->
                  <div class="B silver">
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>B</p>
                          </li>
                       @foreach($sb as $b)
                       <li class="seat">
                         <input type="checkbox" id="SB{{$b}}" />
                         <label for="SB{{$b}}">{{$b}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- C Silver -->
                  <div class="C silver">
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>C</p>
                          </li>
                       @foreach($sc as $c)
                       <li class="seat">
                         <input type="checkbox" id="SC{{$c}}" />
                         <label for="SC{{$c}}">{{$c}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- D Silver -->
                  <div class="D silver">
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>D</p>
                          </li>
                       @foreach($sd as $d)
                       <li class="seat">
                         <input type="checkbox" id="SD{{$d}}" />
                         <label for="SD{{$d}}">{{$d}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- E Silver -->
                  <div class="E silver">
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>E</p>
                          </li>
                       @foreach($se as $e)
                       <li class="seat">
                         <input type="checkbox" id="SE{{$e}}" />
                         <label for="SE{{$e}}">{{$e}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- F Silver -->
                  <div class="F silver">
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>F</p>
                          </li>
                       @foreach($sf as $f)
                       <li class="seat">
                         <input type="checkbox" id="SF{{$f}}" />
                         <label for="SF{{$f}}">{{$f}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- G Silver -->
                  <div class="G silver">
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>G</p>
                          </li>
                       @foreach($sg as $g)
                       <li class="seat">
                         <input type="checkbox" id="SG{{$g}}" />
                         <label for="SG{{$g}}">{{$g}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- H Silver -->
                  <div class="H silver">
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>H</p>
                          </li>
                        @foreach($sh as $h)
                        <li class="seat">
                         <input type="checkbox" id="SH{{$h}}" />
                         <label for="SH{{$h}}">{{$h}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- I Silver -->
                  <div class="I silver">
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>I</p>
                          </li>
                       @foreach($si as $i)
                       <li class="seat">
                         <input type="checkbox" id="SI{{$i}}" />
                         <label for="SI{{$i}}">{{$i}}</label>
                       </li>
                       @if($i == 13)
                       <li class="seat">
                           <span style="width:35px"></span>
                       </li>
                       @endif
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- J Silver -->
                  <div class="J silver">
                  <div class="left">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>J</p>
                          </li>
                       @foreach($sj as $j)
                       <li class="seat">
                         <input type="checkbox" id="SJ{{$j}}" />
                         <label for="SJ{{$j}}">{{$j}}</label>
                       </li>
                       @if($j == 14)
                       <li class="seat">
                           <span style="width:35px"></span>
                       </li>
                       @endif
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- K Silver -->
                  <div class="K silver">
                  <div class="left">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>K</p>
                          </li>
                       @foreach($sk as $k)
                       <li class="seat">
                         <input type="checkbox" id="SK{{$k}}" />
                         <label for="SK{{$k}}">{{$k}}</label>
                       </li>
                       @if($k == 14)
                       <li class="seat">
                           <span style="width:35px"></span>
                       </li>
                       @endif
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- L Silver -->
                  <div class="L silver">
                  <div class="left">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>L</p>
                          </li>
                       @foreach($sl as $l)
                       <li class="seat">
                         <input type="checkbox" id="SL{{$l}}" />
                         <label for="SL{{$l}}">{{$l}}</label>
                       </li>
                       @if($l == 14)
                       <li class="seat">
                           <span style="width:35px"></span>
                       </li>
                       @endif
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- M Silver -->
                  <div class="M silver">
                  <div class="left">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>M</p>
                          </li>
                       <li class="seat">
                           <span style="width:108px"></span>
                       </li>
                       @foreach($sm as $m)
                       <li class="seat">
                         <input type="checkbox" id="SM{{$m}}" />
                         <label for="SM{{$m}}">{{$m}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- N Silver -->
                  <div class="N silver">
                  <div class="left">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>N</p>
                          </li>
                     <li class="seat">
                           <span style="width:108px"></span>
                       </li>
                       @foreach($sn as $n)
                       <li class="seat">
                         <input type="checkbox" id="SN{{$n}}" />
                         <label for="SN{{$n}}">{{$n}}</label>
                       </li>
                       @endforeach
                     </ol>
                  </div>
                  </div>
               </div>
            </div>

            <!-- VIP & GOLD Start -->
            <div class="col-md-6 col-6 mid-sec">
               <div class="vip-sec">
                  <h1 class="text-center">VIP</h1>
                  <!-- A Red VIP -->
                  <div class="A red">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_a as $a)
                       <li class="seat">
                         <input type="checkbox" id="A{{$a}}" />
                         <label for="A{{$a}}">{{$a}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                           <p style="color:#212529">A</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p style="color:#212529">A</p>
                          </li>
                          @foreach($vip_a_right as $a)
                           <li class="seat">
                             <input type="checkbox" id="AR{{$a}}" />
                             <label for="AR{{$a}}">{{$a}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- B Red VIP -->
                  <div class="B red">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_b as $b)
                       <li class="seat">
                         <input type="checkbox" id="B{{$b}}" />
                         <label for="B{{$b}}">{{$b}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                           <p>B</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>B</p>
                          </li>
                          @foreach($vip_b_right as $b)
                           <li class="seat">
                             <input type="checkbox" id="BR{{$b}}" />
                             <label for="BR{{$b}}">{{$b}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- C Red VIP -->
                  <div class="C red">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_c as $c)
                       <li class="seat">
                         <input type="checkbox" id="C{{$c}}" />
                         <label for="C{{$c}}">{{$c}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                           <p>C</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>C</p>
                          </li>
                          @foreach($vip_c_right as $c)
                           <li class="seat">
                             <input type="checkbox" id="CR{{$c}}" />
                             <label for="CR{{$c}}">{{$c}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- D Red VIP -->
                  <div class="D red">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_d as $d)
                       <li class="seat">
                         <input type="checkbox" id="D{{$d}}" />
                         <label for="D{{$d}}">{{$d}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>D</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>D</p>
                          </li>
                          @foreach($vip_d as $d)
                           <li class="seat">
                             <input type="checkbox" id="DR{{$d}}" />
                             <label for="DR{{$d}}">{{$d}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- E Red VIP -->
                  <div class="E red">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_e as $e)
                       <li class="seat">
                         <input type="checkbox" id="E{{$e}}" />
                         <label for="E{{$e}}">{{$e}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>E</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>E</p>
                          </li>
                          @foreach($vip_e_right as $e)
                           <li class="seat">
                             <input type="checkbox" id="ER{{$e}}" />
                             <label for="ER{{$e}}">{{$e}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- F Yellow GOLD -->
                  <div class="F yellow">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_f as $f)
                       <li class="seat">
                         <input type="checkbox" id="F{{$f}}" />
                         <label for="F{{$f}}">{{$f}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>F</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>F</p>
                          </li>
                          @foreach($vip_f_right as $f)
                           <li class="seat">
                             <input type="checkbox" id="FR{{$f}}" />
                             <label for="FR{{$f}}">{{$f}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- G Yellow GOLD -->
                  <div class="G yellow">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_g as $g)
                       <li class="seat">
                         <input type="checkbox" id="G{{$g}}" />
                         <label for="G{{$g}}">{{$g}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>G</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>G</p>
                          </li>
                          @foreach($vip_g_right as $g)
                           <li class="seat">
                             <input type="checkbox" id="GR{{$g}}" />
                             <label for="GR{{$g}}">{{$g}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- H Yellow GOLD -->
                  <div class="H yellow">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_h as $h)
                       <li class="seat">
                         <input type="checkbox" id="H{{$h}}" />
                         <label for="H{{$h}}">{{$h}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>H</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>H</p>
                          </li>
                          @foreach($vip_h_right as $h)
                           <li class="seat">
                             <input type="checkbox" id="HR{{$h}}" />
                             <label for="HR{{$h}}">{{$h}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- I Yellow GOLD -->
                  <div class="I yellow">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_i as $i)
                       <li class="seat">
                         <input type="checkbox" id="I{{$i}}" />
                         <label for="I{{$i}}">{{$i}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>I</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>I</p>
                          </li>
                          @foreach($vip_i_right as $i)
                           <li class="seat">
                             <input type="checkbox" id="IR{{$i}}" />
                             <label for="IR{{$i}}">{{$i}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- J Yellow GOLD -->
                  <div class="J yellow">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_j as $j)
                       <li class="seat">
                         <input type="checkbox" id="J{{$j}}" />
                         <label for="J{{$j}}">{{$j}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>J</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>J</p>
                          </li>
                          @foreach($vip_j_right as $j)
                           <li class="seat">
                             <input type="checkbox" id="JR{{$j}}" />
                             <label for="JR{{$j}}">{{$j}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- K Yellow GOLD -->
                  <div class="K yellow">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_k as $k)
                       <li class="seat">
                         <input type="checkbox" id="K{{$k}}" />
                         <label for="K{{$k}}">{{$k}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>K</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>K</p>
                          </li>
                          @foreach($vip_k_right as $k)
                           <li class="seat">
                             <input type="checkbox" id="KR{{$k}}" />
                             <label for="KR{{$k}}">{{$k}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- L Yellow GOLD -->
                  <div class="L yellow">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_l as $l)
                       <li class="seat">
                         <input type="checkbox" id="L{{$l}}" />
                         <label for="L{{$l}}">{{$l}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>L</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>L</p>
                          </li>
                          @foreach($vip_l_right as $l)
                           <li class="seat">
                             <input type="checkbox" id="LR{{$l}}" />
                             <label for="LR{{$l}}">{{$l}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- M Yellow GOLD -->
                  <div class="M yellow">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_m as $m)
                       <li class="seat">
                         <input type="checkbox" id="M{{$m}}" />
                         <label for="M{{$m}}">{{$m}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>M</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>M</p>
                          </li>
                          @foreach($vip_m_right as $m)
                           <li class="seat">
                             <input type="checkbox" id="MR{{$m}}" />
                             <label for="MR{{$m}}">{{$m}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- N Yellow GOLD -->
                  <div class="N yellow">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($vip_n as $n)
                       <li class="seat">
                         <input type="checkbox" id="N{{$n}}" />
                         <label for="N{{$n}}">{{$n}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>N</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>N</p>
                          </li>
                          @foreach($vip_n_right as $n)
                           <li class="seat">
                             <input type="checkbox" id="NR{{$n}}" />
                             <label for="NR{{$n}}">{{$n}}</label>
                           </li>
                          @endforeach
                     </ol>
                  </div>
                  </div>
                  <!-- O Yellow GOLD -->
                  <div class="O yellow">
                  <div class="left">
                     <ol class="seats-left">
                        @foreach($vip_o as $o)
                       <li class="seat">
                         <input type="checkbox" id="O{{$o}}" />
                         <label for="O{{$o}}">{{$o}}</label>
                       </li>
                        @endforeach
                        <li class="seat">
                           <p>O</p>
                       </li>
                     </ol> 
                  </div>
                  <div class="right">
                     <ol class="seats-right">
                        <li class="seat">
                              <p>O</p>
                          </li>
                          @foreach($vip_o_right as $o)
                           <li class="seat">
                             <input type="checkbox" id="OR{{$o}}" />
                             <label for="OR{{$o}}">{{$o}}</label>
                           </li>
                          @endforeach
                     </ol>
                     <div class="light-desk">
                    <p>Light & Sound Desk</p>
                  </div>
                  </div>
                  </div>
                  <h2 class="text-center gold">GOLD</h2>
               </div>
            </div>
            <!-- VIP & GOLD End -->
            <!-- Silver Right -->
            <div class="col-md-3 col-3 right-sec">
               <div class="silver-sec-right">
                  <h1 class="text-center">SILVER</h1>
                  <!-- A Silver -->
                  <div class="A silver">
                  <div class="right">
                     <ol class="seats-left">
                       @foreach($sra as $a)
                       <li class="seat">
                         <input type="checkbox" id="SRA{{$a}}" />
                         <label for="SRA{{$a}}">{{$a}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                           <p style="color:#212529">A</p>
                       </li>
                     </ol>
                  </div>
                  </div>
                  <!-- B Silver -->
                  <div class="B silver">
                  <div class="right">
                     <ol class="seats-left">
                       @foreach($srb as $b)
                       <li class="seat">
                         <input type="checkbox" id="SRB{{$b}}" />
                         <label for="SRB{{$b}}">{{$b}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                            <p>B</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- C Silver -->
                  <div class="C silver">
                  <div class="right">
                     <ol class="seats-left">
                       @foreach($src as $c)
                       <li class="seat">
                         <input type="checkbox" id="SRC{{$c}}" />
                         <label for="SRC{{$c}}">{{$c}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                            <p>C</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- D Silver -->
                  <div class="D silver">
                  <div class="right">
                     <ol class="seats-left">
                       @foreach($srd as $d)
                       <li class="seat">
                         <input type="checkbox" id="SRD{{$d}}" />
                         <label for="SRD{{$d}}">{{$d}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                            <p>D</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- E Silver -->
                  <div class="E silver">
                  <div class="right">
                     <ol class="seats-left">
                       @foreach($sre as $e)
                       <li class="seat">
                         <input type="checkbox" id="SRE{{$e}}" />
                         <label for="SRE{{$e}}">{{$e}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                            <p>E</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- F Silver -->
                  <div class="F silver">
                  <div class="right">
                     <ol class="seats-left">
                       @foreach($srf as $f)
                       <li class="seat">
                         <input type="checkbox" id="SRF{{$f}}" />
                         <label for="SRF{{$f}}">{{$f}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                            <p>F</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- G Silver -->
                  <div class="G silver">
                  <div class="right">
                     <ol class="seats-left">
                       @foreach($srg as $g)
                       <li class="seat">
                         <input type="checkbox" id="SRG{{$g}}" />
                         <label for="SRG{{$g}}">{{$g}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                            <p>G</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- H Silver -->
                  <div class="H silver">
                  <div class="right">
                     <ol class="seats-left">
                       @foreach($srh as $h)
                       <li class="seat">
                         <input type="checkbox" id="SRH{{$h}}" />
                         <label for="SRH{{$h}}">{{$h}}</label>
                       </li>
                       @endforeach
                       <li class="seat">
                            <p>H</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- I Silver -->
                  <div class="I silver">
                  <div class="right">
                     <ol class="seats-left">
                        @foreach($sri as $i)
                        <li class="seat">
                           <input type="checkbox" id="SRI{{$i}}" />
                           <label for="SRI{{$i}}">{{$i}}</label>
                        </li>
                        @if($i == 7)
                        <li class="seat">
                            <span style="width:35px"></span>
                        </li>
                        @endif
                        @endforeach
                        <li class="seat">
                            <p>I</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- J Silver -->
                  <div class="J silver">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($srj as $j)
                        <li class="seat">
                           <input type="checkbox" id="SRJ{{$j}}" />
                           <label for="SRJ{{$j}}">{{$j}}</label>
                        </li>
                        @if($j == 7)
                        <li class="seat">
                            <span style="width:35px"></span>
                        </li>
                        @endif
                        @endforeach
                        <li class="seat">
                            <p>J</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- K Silver -->
                  <div class="K silver">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($srk as $k)
                        <li class="seat">
                           <input type="checkbox" id="SRK{{$k}}" />
                           <label for="SRK{{$k}}">{{$k}}</label>
                        </li>
                        @if($k == 7)
                        <li class="seat">
                            <span style="width:35px"></span>
                        </li>
                        @endif
                        @endforeach
                        <li class="seat">
                            <p>K</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- L Silver -->
                  <div class="L silver">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($srl as $l)
                        <li class="seat">
                           <input type="checkbox" id="SRL{{$l}}" />
                           <label for="SRL{{$l}}">{{$l}}</label>
                        </li>
                        @if($l == 7)
                        <li class="seat">
                            <span style="width:35px"></span>
                        </li>
                        @endif
                        @endforeach
                        <li class="seat">
                            <p>L</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- M Silver -->
                  <div class="M silver">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($srm as $m)
                        <li class="seat">
                           <input type="checkbox" id="SRM{{$m}}" />
                           <label for="SRM{{$m}}">{{$m}}</label>
                        </li>
                        @endforeach
                        <li class="seat">
                            <span style="width:108px"></span>
                        </li>
                        <li class="seat">
                            <p>M</p>
                        </li>
                     </ol>
                  </div>
                  </div>
                  <!-- N Silver -->
                  <div class="N silver">
                  <div class="left">
                     <ol class="seats-left">
                       @foreach($srn as $n)
                        <li class="seat">
                           <input type="checkbox" id="SRN{{$n}}" />
                           <label for="SRN{{$n}}">{{$n}}</label>
                        </li>
                        @endforeach
                        <li class="seat">
                            <span style="width:108px"></span>
                        </li>
                        <li class="seat">
                            <p>N</p>
                        </li>
                     </ol>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</body>
<script>
var $checkboxes = $('input[type=checkbox]');
$checkboxes.change(function () {
    if (this.checked) {
        if ($checkboxes.filter(':checked').length == 2) {
            $checkboxes.not(':checked').prop('disabled', true);
        }
    } else {
        $checkboxes.prop('disabled', false);
    }
});
</script>
</html>