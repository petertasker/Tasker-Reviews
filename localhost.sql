
CREATE TABLE Brand 
( 
  BrandName VARCHAR(100) NOT NULL, 
  TimesLogged INT NOT NULL, 
  PRIMARY KEY (brandName) 
); 

CREATE TABLE Users 
( 
  Username VARCHAR(30) NOT NULL, 
  Password VARCHAR(100) NOT NULL, 
  PRIMARY KEY (Username) 
); 

CREATE TABLE Guitar 
(
  GuitarID INT NOT NULL, 
  Make VARCHAR(100) NOT NULL, 
  BrandName VARCHAR(100) NOT NULL, 
  Cost NUMERIC 13,2 NOT NULL, 
  YearMade INT NOT NULL, 
  Signature BOOL NOT NULL, 
  SignatureArtist VARCHAR(100), 
  brandName INT NOT NULL, 
  PRIMARY KEY (GuitarID), 
  FOREIGN KEY (BrandName) REFERENCES Brand(BrandName) 
); 

CREATE TABLE LoggedGuitars 
( 
  LoggedGuitarID INT NOT NULL, 
  Username VARCHAR(30) NOT NULL, 
  GuitarID INT NOT NULL, 
  PRIMARY KEY (LoggedGuitarID), 
  FOREIGN KEY (GuitarID) REFERENCES Guitar(GuitarID), 
  FOREIGN KEY (Username) REFERENCES Users(Username) 
); 
