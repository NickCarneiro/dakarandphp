<?php
function get_wall_clock_micros(): int {
  // milliseconds are to the left of the decimal, just take those with floor
  return intval(microtime(TRUE) * 10000, 10);
}
function flip_coin(): bool {
  $n = FALSE;
  $then = get_wall_clock_micros() + 1;
  // the # of iterations of this loop should be non-deterministic, but biased
  while (get_wall_clock_micros() <= $then) {
    $n = !$n;
  }
  return $n;
}
// Turn a biased coin into a fair coin.
// https://jeremykun.com/2014/02/08/simulating-a-fair-coin-with-a-biased-coin/
function get_fair_bit(): bool {
  while(1) {
    $a = flip_coin();
    // flip the coin until the result is different than the previous then return the value
    // of the first coin the the pair
    if ($a != flip_coin()) {
      return($a);
    }
  }
}

function get_random_byte(): int {
  // php ints are 32 bits on my machine, but we're only looking at the LSB
  $n = 0x00;
  for ($bits = 0; $bits < 8; $bits++) {
    // shift $n one bit to the left
    $n <<= 1;
    // bitwise OR the entirety of $n with our single random bit in least significant position
    // side note: these types don't match, but php doesn't care
    // decbin(true) returns 0x0001
    $n |= get_fair_bit();
  }
  return $n;
}

for($i = 0; $i < 1000; $i++) {
  $random_bit = get_fair_bit();
  echo $random_bit ? '1' : '0';
}
