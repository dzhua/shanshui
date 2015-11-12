<?php

require_once "../Matrix.php";

class TestMatrix {

  function TestMatrix() {

    // define test variables

    $errorCount   = 0;
    $warningCount = 0;
    $columnwise   = array(1.,2.,3.,4.,5.,6.,7.,8.,9.,10.,11.,12.);
    $rowwise      = array(1.,4.,7.,10.,2.,5.,8.,11.,3.,6.,9.,12.);
    $avals        = array(array(1.,4.,7.,10.),array(2.,5.,8.,11.),array(3.,6.,9.,12.));
    $rankdef      = $avals;
    $tvals        = array(array(1.,2.,3.),array(4.,5.,6.),array(7.,8.,9.),array(10.,11.,12.));
    $subavals     = array(array(5.,8.,11.),array(6.,9.,12.));
    $rvals        = array(array(1.,4.,7.),array(2.,5.,8.,11.),array(3.,6.,9.,12.));
    $pvals        = array(array(1.,1.,1.),array(1.,2.,3.),array(1.,3.,6.));
    $ivals        = array(array(1.,0.,0.,0.),array(0.,1.,0.,0.),array(0.,0.,1.,0.));
    $evals        = array(array(0.,1.,0.,0.),array(1.,0.,2.e-7,0.),array(0.,-2.e-7,0.,1.),array(0.,0.,1.,0.));
    $square       = array(array(166.,188.,210.),array(188.,214.,240.),array(210.,240.,270.));
    $sqSolution   = array(array(13.),array(15.));
    $condmat      = array(array(1.,3.),array(7.,9.));
    $rows         = 3;
    $cols         = 4;
    $invalidID    = 5; /* should trigger bad shape for construction with val        */
    $raggedr      = 0; /* (raggedr,raggedc) should be out of bounds in ragged array */
    $raggedc      = 4;
    $validID      = 3; /* leading dimension of intended test Matrices      