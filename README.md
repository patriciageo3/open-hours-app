 
## Synopsis

This is an application designed to dinamically update the contact page section of a website with custom messages depending on the **Open/ Working Hours** of that bussiness, thus informing the client if the shop/ restaurant is open at the current time he/she is accessing the website.  

It was created with the help of:

* PHP

## Installation

No installation is needed. The file may be incorporated in the website using:
`<?php include ("pathToTheFile/application_open_hours.php"); ?>`

## How it works

You need to update `$open_hours` and `$holidays` arrays according to the schedule of your bussiness, following the rules below:

* Insert hour intervals in the 24 hours format; if you wish to target 12am, 23:59 is advised;
* If one day is completely off, use the interval "00:00-00:00";
* For holidays, put the day in the format day/month without zeros and the specific hours using 24 hours format;
* If you are off the whole day in the holiday, use "00:00-00:00" in the specific hour interval;
* In order to guarantee that this application runs smoothly, please do not change the formatting of the input days, hours or holidays and respect the above rules thoroughly!

## Sample Previews

Below you may find some of the messages that the application shows to the user depending on the moment he/ she accesses the website and the working bussiness hours:

1. Message-preview outputed when user accesses website while the bussiness is opened:

![Alt text](screenShots/01.JPG?raw=true "App Preview 1")

2. Message-preview showed when user accesses website before the bussiness actually opens in a working day:

![Alt text](screenShots/03.JPG?raw=true "App Preview 2")

3. Message shown if user accesses the website after the bussiness has closed for the current day, but it is opened tomorrow:

![Alt text](screenShots/02.JPG?raw=true "App Preview 3")

4. Message-preview in case of national holidays, with all day off:

![Alt text](screenShots/04.JPG?raw=true "App Preview 4")

5. Message-preview outputed on national holidays, but when the bussiness is open at the moment the user accesses the website:

![Alt text](screenShots/05.JPG?raw=true "App Preview 5")

And the list of custom messages continues...

## Contributors

Patricia Georgescu

## License

This is an application I designed from scratch, with the level of PHP that I had at the time.
Please be advised that this application might not be using the most modern tools there are in PHP.
I do not consider myself a master PHP developer, so any advice that might help me improve this is highly appreciated.
