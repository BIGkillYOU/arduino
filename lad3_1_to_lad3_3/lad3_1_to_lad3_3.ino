#include <Keypad.h>

int RGB_RED_PIN=16;
int RGB_BLUE_PIN=5;
int RGB_GREEN_PIN=4;
int POTENTIOMETER_PIN=A0;

int b1=0;
int b2=2;
int b3=14;
int b4=12;

void setup() {
  pinMode(16, OUTPUT);
  pinMode(5, OUTPUT);
  pinMode(4, OUTPUT);
  analogWrite(16,984);
  analogWrite(5,492);
  analogWrite(4,88);

  Serial.begin(9600);

  pinMode(RGB_RED_PIN, OUTPUT);
  pinMode(RGB_BLUE_PIN, OUTPUT);
  pinMode(RGB_GREEN_PIN, OUTPUT);

  pinMode(b1, INPUT);
  pinMode(b2, INPUT);
  pinMode(b3, INPUT);
  pinMode(b4, INPUT);
}

void lad3_1(){
  digitalWrite(16, 1);
  delay(500);
  digitalWrite(16, 0);
  delay(500);
  
  digitalWrite(5, 1);
  delay(500);
  digitalWrite(5, 0);
  delay(500);
  
  digitalWrite(4, 1);
  delay(500);
  digitalWrite(4, 0);
  delay(500);
}

void loop() {
  //lad3_1();
  //lad3_2();
  
  lad3_3();
}
