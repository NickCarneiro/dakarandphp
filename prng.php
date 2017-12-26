<?php
for ($i = 0; $i < 1000; $i++) {
  $random_int = rand();
  $random_bit = 0x0001 & $random_int;
  echo $random_bit ? '1' : '0';
}