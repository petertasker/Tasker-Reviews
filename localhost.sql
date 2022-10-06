
CREATE TABLE Brand
(
  BrandName VARCHAR(100) NOT NULL,
  YearEst INT NOT NULL,
  PRIMARY KEY (brandName)
);
 
CREATE TABLE Users
(
  UserID INT NOT NULL,
  Username VARCHAR(30) NOT NULL,
  Password VARCHAR(100) NOT NULL,
  PRIMARY KEY (UserID)
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
  UserID INT NOT NULL,
  GuitarID INT NOT NULL,
  PRIMARY KEY (LoggedGuitarID),
  FOREIGN KEY (GuitarID) REFERENCES Guitar(GuitarID),
  FOREIGN KEY (UserID) REFERENCES Users(UserID)
);
