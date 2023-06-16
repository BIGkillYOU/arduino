void ledrun(){
  for (int i = 0; i <= 3 ; i++ ) {
    digitalWrite(LED[i], 1);
    delay(500);
    digitalWrite(LED[i], 0);
    delay(500);
  }
  digitalWrite(BUS, 1);
  delay(500);
  digitalWrite(BUS, 0);
  }
