
int LED[] = {16, 5, 4, 0};
int BUS=2 ;
void setup(){
  pinMode(LED[0], OUTPUT);
  pinMode(LED[1], OUTPUT);
  pinMode(LED[2], OUTPUT);
  pinMode(LED[3], OUTPUT);
  pinMode(BUS, OUTPUT);
}
void loop() {
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
