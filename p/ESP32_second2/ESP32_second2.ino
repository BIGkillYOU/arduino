#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid     = "KingBig";
const char* password = "bigkill1";
const char* host = "192.168.216.192";
const int httpPort = 80;

const int soilMoisturePin = 34;
const int relayPin = 5; // Pin connected to the relay

void setup()
{
    Serial.begin(115200);
    Serial.println("Soil Moisture Sensor Output!");

    pinMode(relayPin, OUTPUT);
    digitalWrite(relayPin, LOW); // Ensure relay is off at startup

    Serial.println();
    Serial.print("Connecting to ");
    Serial.println(ssid);

    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }

    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());
}

void loop()
{
    int soilMoistureValue = analogRead(soilMoisturePin);
    float soilMoisturePercentage = map(soilMoistureValue, 0, 4095, 0, 100);

    Serial.print("Soil Moisture Value: ");
    Serial.print(soilMoistureValue);
    Serial.print(" | Percentage: ");
    Serial.print(soilMoisturePercentage);
    Serial.println(" %");

    delay(3000);

    Serial.print("connecting to ");
    Serial.println(host);

    if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;
        String url = String("http://") + host + "/Water_Reduction_Project_Web/dist/config1.php?"; // PHP script to get inputnum
        http.begin(url);

        int httpResponseCode = http.GET();

        if (httpResponseCode == 200) {
            String payload = http.getString();
            int inputnum = payload.toInt(); // Convert payload to integer

            Serial.print("Input number from database: ");
            Serial.println(inputnum);

            if (soilMoisturePercentage <= inputnum) {
                digitalWrite(relayPin, HIGH); // Turn on the relay
                Serial.println("Relay ON");
            } else {
                digitalWrite(relayPin, LOW); // Turn off the relay
                Serial.println("Relay OFF");
            }
        } else {
            Serial.print("Error in HTTP request, code: ");
            Serial.println(httpResponseCode);
        }

        http.end();
    } else {
        Serial.println("WiFi disconnected");
    }

    WiFiClient client;
    if (!client.connect(host, httpPort)) {
        Serial.println("connection failed");
        return;
    }

    client.print(String("GET /Water_Reduction_Project_Web/dist/config1.php?") +
                 "soil_moisture=" + soilMoisturePercentage +
                 " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");

    unsigned long timeout = millis();
    while (client.available() == 0) {
        if (millis() - timeout > 1000) {
            Serial.println(">>> Client Timeout !");
            client.stop();
            return;
        }
    }

    while(client.available()) {
        String line = client.readStringUntil('\r');
        Serial.print(line);
    }

    Serial.println();
    Serial.println("closing connection");
}
