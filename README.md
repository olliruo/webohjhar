# webohjhar
Toimintolista Web-ohjelmoinnin harjoitustyölle
Olli-Pekka Ruottinen

1.	Rekisteröityminen
	Sama käyttäjä ei saa rekisteröityä kuin kerran.
	Salasana kysytään kaksi kertaa, niitä vertaillaan varmennukseksi sille, 
	että salasana on syötetty varmasti kuten käyttäjä aikoi.
2.	Kirjautuminen
	Sisään voi kirjautua kirjoittamalla olemassa olevan käyttäjätunnuksen ja sitä vastaavan salasanan.
	Jos tunnus/salasana on väärin, ohjataan käyttäjä takaisin kirjautumissivulle.
3.	Omien tietojen muuttaminen
	Käyttäjä voi muuttaa omia tietojaan. Muutoslomakkeella on vanhat tiedot
	oletuksena kentissä, joita käyttäjä voi editoida haluamallaan tavalla.
4.	Uloskirjautuminen
	Käyttäjä voi kirjautua ulos sovelluksesta. Uloskirjauksen jälkeen käyttäjä siirtyy kirjautumis-
	sivulle, jossa hän voi kirjautua sivulle uudestaan.
5.	Laitteen lisääminen
	Vain Admin-käyttäjä voi lisätä uuden laitteen. Laitteen voi lisätä ominaisuuksineen, joita ovat
	nimi, malli, merkki, kuvaus, sijainti, omistaja, kategoria ja sarjanumero.
6.	Laitteen muuttaminen
	Vain Admin-käyttäjä voi muuttaa laitteen tietoja.
7.	Laitteen poistaminen
	Vain Admin-käyttäjä voi poistaa laitteen.
	Laitetta ei voi poistaa, jos laitteeseen liittyy varaus/lainaus.
8.	Laitteiden selaaminen
	Laitteita on voitava hakea nimen, mallin, merkin, sijainnin, omistajan, kategorian ja/tai sarjanumeron perusteella.
	Käyttäjä voi antaa minkä tahansa em. hakuehtojen kombinaation.
9.	Laitteen varaaminen
	Laitteen voi varata kuka tahansa kirjautunut käyttäjä.
9.1	Laitteen varaaminen, tarkistukset
	Laitetta ei voi varata, jos laite on jo varattu.
10.	Laitteen varauksen poistaminen	
	Laitteen varauksen voi purkaa admin-käyttäjä tai laitteen
	varannut käyttäjä. 
11.	Laitteen varauksen muuttaminen
	Vain Admin-käyttäjä voi poistaa laitteen.
	Laitteen varausta voi muuttaa admin-käyttäjä tai laitteen varannut käyttäjä.
