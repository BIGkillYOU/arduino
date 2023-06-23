void lad3_2(){
  int potentiometerValue = analogRead(POTENTIOMETER_PIN);
  int rgbValue = map(potentiometerValue, 0, 1023, 0, 1535);

  int red;
  int blue;
  int green;

  Serial.println(rgbValue);
  delay(1000); 
  
  if (rgbValue < 256) {
    red = 255;
    blue = rgbValue;
    green = 0;
  }
  else if (rgbValue < 512) {
    red = 511 - rgbValue;
    blue = 255;
    green = 0;
  }
  else if (rgbValue < 768) {
    red = 0;
    blue = 255;
    green = rgbValue - 512;
  }
  else if (rgbValue < 1024) {
    red = 0;
    blue = 1023 - rgbValue;
    green = 255;
  }
  else if (rgbValue < 1280) {
    red = rgbValue - 1024;
    blue = 0;
    green = 255;
  }
  else {
    red = 255;
    blue = 0;
    green = 1535 - rgbValue;
  }
  
  analogWrite(RGB_RED_PIN, red);
  analogWrite(RGB_BLUE_PIN, blue);
  analogWrite(RGB_GREEN_PIN, green);
}
