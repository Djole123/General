--q1a--
SELECT *
FROM Movie
WHERE GrossEarnings > 1200000 AND GrossEarnings < 1300000;

--q1b--
SELECT OscarYear, ActorID, FirstName, LastName
FROM Act, Person
WHERE ActorID = ID
GROUP BY OscarYear, ActorID, FirstName, LastName
HAVING COUNT(ActorID) >= 2;

--q2--
SELECT Person.ID, FirstName, LastName, Occupation
FROM Person, PhoneNumber, Own, Goer
WHERE Person.ID = PersonID AND PhoneNumber.ID = PhoneNumberID AND Person.ID = Goer.ID 
AND Work IS NOT NULL AND Home IS NOT NULL AND Cell IS NOT NULL AND LEFT(Province, 1) = 'O';

--q3a--
SELECT Movie.ID, Movie.Genre, Movie.Title 
FROM Direct JOIN Movie ON Movie.ID = Direct.MovieID 
JOIN Person ON Person.ID = Direct.DirectorID 
WHERE Person.FirstName = 'Gennadi' 
ORDER BY GrossEarnings DESC FETCH FIRST 1 ROWS ONLY;

--q3b--					
SELECT a.ID, a.Genre, a.Title
FROM Movie a
WHERE NOT EXISTS (SELECT b.ID
					FROM Movie b
					WHERE b.GrossEarnings > a.GrossEarnings);

--q4a--					
SELECT ActorID, COUNT(ActorID) AS NumberOfMovies
FROM Act
GROUP BY ActorID
HAVING COUNT(ActorID) > 5;

--q4b--
SELECT a.ActorID, FirstName, LastName
FROM Act a, Person
WHERE a.ActorID = ID
GROUP BY a.ActorID, FirstName, LastName
HAVING NOT EXISTS (SELECT b.ActorID
					FROM Act b, Person
					WHERE b.ActorID = ID
					GROUP BY b.ActorID
					HAVING COUNT(b.ActorID) > COUNT(a.ActorID));

--q5--					
SELECT COUNT(ID) AS NumberOfOrders, DATE(Make.Date) AS OrderDate
FROM Make, Transaction
WHERE TransactionID = ID AND PaymentMethod = 'debit' OR PaymentMethod = 'credit'
GROUP BY DATE(Make.Date);

--q6--
SELECT DISTINCT(Person.ID), FirstName, LastName
FROM Person, Visit, Make, Transaction
WHERE Visit.GoerID = Person.ID AND Make.GoerID = Person.ID AND TransactionID = Transaction.ID
AND PaidAmount > 20 AND Visit.Price > 18;

--q7a--
SELECT StudioAffiliation, COUNT(DirectorID) AS NumberOfMovies
FROM Director, Direct
WHERE DirectorID = Director.ID
GROUP BY StudioAffiliation;

--q7b--
SELECT StudioAffiliation, COUNT(DirectorID) AS NumberOfMovies
FROM Director, Direct
WHERE DirectorID = Director.ID AND Budget >= 7000000 AND AwardName IS NOT NULL
GROUP BY StudioAffiliation;

--q8--
SELECT DISTINCT(Movie.ID), Movie.Genre, Movie.Title, Movie.ReleaseDate
FROM Show, Visit, Movie, Goer, Actor
WHERE Movie.ID = Show.MovieID AND Show.MovieTheaterID = Visit.MovieTheaterID AND 
		Visit.GoerID = Goer.ID AND Visit.GoerID = Actor.ID;

--q9a--
SELECT a.MovieTheaterID, a.Type, SUM(c.Quantity) ItemsSold 
FROM ConcessionStand a, Sold b, Belong c
WHERE a.MovieTheaterID = b.MovieTheaterID AND a.Type = b.Type AND b.ProductID = c.ProductID
GROUP BY a.MovieTheaterID, a.Type
HAVING SUM(c.Quantity) > 50
ORDER BY ItemsSold ASC;

--q9b--
SELECT DISTINCT a.MovieTheaterID, a.Type, SUM(c.PaidAmount) AS TotalEarned
FROM ConcessionStand a, Sold b, Transaction c, Belong d
WHERE a.MovieTheaterID = b.MovieTheaterID AND a.Type = b.Type AND b.ProductID = d.ProductID AND d.TransactionID = c.ID
GROUP BY a.MovieTheaterID, a.Type
HAVING SUM(c.PaidAmount) > 570
ORDER BY TotalEarned ASC;

--q10--
SELECT DISTINCT(x.ID), x.FirstName, x.LastName, x.Occupation
FROM Person x, Visit a
WHERE a.GoerID = x.ID
GROUP BY x.ID, x.FirstName, x.LastName, x.Occupation, a.Date, a.GoerID
HAVING a.GoerID IN (SELECT b.GoerID
				FROM Visit b
				WHERE EXTRACT(YEAR FROM Date) = 2013) AND a.GoerID IN (SELECT c.GoerID
																			FROM Visit c
																			WHERE EXTRACT(YEAR FROM Date) = 2014) AND a.GoerID IN (SELECT d.GoerID
																																		FROM Visit d
																																		WHERE EXTRACT(YEAR FROM Date) = 2015);

--q11a--	
SELECT DISTINCT(MovieTheater.ID), MovieTheater.Name, MovieTheater.Province
FROM Movie a, Movie b, MovieTheater, Show aa, Show bb
WHERE MovieTheater.ID = aa.MovieTheaterID AND a.ID = aa.MovieID AND MovieTheater.ID = bb.MovieTheaterID
AND b.ID = bb.MovieID AND a.Genre = 'H' AND b.Genre = 'R' AND aa.Day = bb.Day;

--q11b--
SELECT DISTINCT(MovieTheater.ID), MovieTheater.Name, MovieTheater.Province
FROM MovieTheater, Visit a, Visit b
WHERE MovieTheater.ID = a.MovieTheaterID AND MovieTheater.ID = b.MovieTheaterID
GROUP BY MovieTheater.ID, MovieTheater.Name, MovieTheater.Province, Screens, a.Date, b.Date, a.Price
HAVING Screens >= 4 AND EXTRACT(YEAR FROM a.Date) = EXTRACT(YEAR FROM b.Date) AND SUM(a.Price) < 10000;

--q12--
SELECT Category, SUM(Price*Quantity) AS TotalSalesAmount
FROM Belong, Product
WHERE Product.ID = ProductID
GROUP BY Category
ORDER BY TotalSalesAmount DESC FETCH FIRST 1 ROWS ONLY;