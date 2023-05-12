#include <SoftwareSerial.h>
SoftwareSerial RFID(14, 2);  // RX and TX

#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 16, 2);

#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>

const char* ssid = "Goeboeg99dua";
const char* password = "Ramadhantiba";
//Your Domain name with URL path or IP address with path
// String serverName = "http://192.168.1.2/ailab/admin/mikromhsw.php";  //mahasiswa
String serverName = "http://192.168.1.2/ailab/admin/mikrobarang.php";  //barang
String text;


const int led = 0;    //HIJAU
const int led2 = 16;  //MERAH
const int pb = 13;

int mod;
int statuspb = 0;
int kirim = 0;

char b[12];


void setup() {
  lcd.begin();
  Serial.begin(115200);

  pinMode(led, OUTPUT);
  pinMode(led2, OUTPUT);
  pinMode(pb, INPUT_PULLUP);

  digitalWrite(led, LOW);
  digitalWrite(led2, LOW);

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    lcd.setCursor(0, 0);
    lcd.print("conecting...");
    //    Serial.print (".");
    //    lcd.clear();
  }
  Serial.println();
  Serial.print("connect wifi, IP Adress : ");
  Serial.println(WiFi.localIP());
  Serial.print("connect to :");
  Serial.println(ssid);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("conected");
  delay(2000);


  RFID.begin(9600);
  Serial.println("Dekatkan kartu...");

  lcd.setCursor(0, 0);
  lcd.print("dekatkan kartu");

  //  pinMode (led, OUTPUT);
  //  pinMode (led2, OUTPUT);
  //  pinMode (pb, INPUT_PULLUP);
  //
  //  digitalWrite (led, LOW);
  //  digitalWrite (led2, LOW);
}
char c;

void loop() {
  if (digitalRead(pb) == 0) {
    statuspb = !statuspb;
    delay(300);
  }
  if (statuspb == 0) {
    digitalWrite(led, HIGH);  //HIJAU
    digitalWrite(led2, LOW);
    mod = 0;
  }
  if (statuspb == 1) {
    digitalWrite(led, LOW);  //MERAH
    digitalWrite(led2, HIGH);
    mod = 1;
  }
  while (RFID.available() > 0) {
    delay(5);
    c = RFID.read();
    text += c;
  }
  if (text.length() > 20u)
    check();
  text = "";

  if (kirim > 0) {
    komunikasi();
  }
}

void check() {
  text = text.substring(1, 11);
  Serial.println("Card ID : " + text);

  text.toCharArray(b, 12);

  Serial.println(b);  // cek convert data
  kirim = 1;

  tone(15, 450);
  delay(200);
  noTone(15);
  delay(200);
  tone(15, 450);
  delay(200);
  noTone(15);
  delay(200);

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print(mod);
  lcd.setCursor(0, 1);
  lcd.print(text);
  delay(3000);
  lcd.clear();

  //  Serial.println("Access ID : " + CardNumber);
  lcd.setCursor(0, 0);
  lcd.print(text);

  Serial.println(" ");
  Serial.println("Dekatkan kartu...");
  lcd.setCursor(0, 0);
  lcd.print("dekatkan kartu");
}

void komunikasi() {


  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;
    http.begin(client, serverName);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");


    String postData = "?rfid=" + String(b);
    int httpResponseCode = http.POST(postData);

    if (httpResponseCode > 0) {
      Serial.printf("HTTP POST request sent with status code: %d\n", httpResponseCode);
      String response = http.getString();
      Serial.println("Response: " + response);
      Serial.println(postData);
    } else {
      Serial.printf("HTTP POST request failed with error code: %d\n", httpResponseCode);
    }
    http.end();
  } else {
    Serial.println("WiFi not connected");
  }
  kirim = 0;
  //  delay(2000);
}
