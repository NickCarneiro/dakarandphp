<?php
function get_wall_clock_millis(): int {
  // milliseconds are to the left of the decimal, just take those with floor
  return intval(floor(microtime(TRUE)));
}
function flip_coin(): bool {
  $n = FALSE;
  $then = get_wall_clock_millis() + 1;
  // the # of iterations of this loop should be non-deterministic, but biased
  while (get_wall_clock_millis() <= $then) {
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
  // php ints are 16 bits
  $n = 0x0000;
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

$byte = get_random_byte();
echo decbin($byte) . "\n";