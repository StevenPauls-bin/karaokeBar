# KaraokeBar

KaraokeBar is a web-based karaoke management application that allows
singers to search for songs, select karaoke versions, and join a
singing queue. DJs can manage the queue and control the order in
which singers perform. This was created in a group project of my self and 2 other peers

## Features

### Singer Interface
- Search for songs by title or artist
- View available karaoke versions
- Add songs to the singing queue
- Join either the standard or priority queue
- View the current queue

### DJ Interface
- View the current singing queue
- Manage and advance the queue
- View singer and song information
- Support priority singers

## Technologies

- PHP
- SQL / Relational Database
- HTML
- CSS
- JavaScript
- Hack

## Database

The application uses a relational database to manage:

- Songs
- Artists and contributors
- Karaoke files
- Users
- Singing queues
- Queue entries

The database uses relationships between these entities to allow songs,
artists, karaoke versions, and queue information to be managed
independently.

## Application Structure

The application provides separate interfaces for singers and DJs.

**Singer workflow:**

Search for a song → Select a karaoke version → Join queue → Wait to perform

**DJ workflow:**

View queue → Manage singers → Advance to next performance

## Screenshots

_Add screenshots of the main singer and DJ interfaces here._

## Project Highlights

- Designed and implemented database-backed application functionality
- Built song searching and karaoke-version selection
- Implemented queue management and priority queue behavior
- Created separate workflows for singers and DJs
- Worked with relational database queries and application logic

## Running the Project

_Add the actual setup instructions here._

1. Clone the repository
2. Set up the required database
3. Configure the database connection
4. Start the PHP application
5. Open the application in a web browser

## Project Background

This project was developed as part of a college software development
course. The project involved designing a database-backed web
application and implementing the required functionality for both
singers and DJs.

This project was to demonstrate proficiency with basic database design   

The Following were the requirements of the project
Application

    The application you will be designing and implementing will be a web-based, database driven tool to facilitate the running of karaoke events at a bar or
    other venue. It must allow users to sign up to sing songs from the list of available songs, and also provide the DJ information needed to call up the next
    singer.

Searching for songs

    The potential singer should be able to search through a list of songs by either the artist name, the title of the song, or the name of one of the contributors. A
    contributor is someone who has contributed to the creation of the song in some significant way, such as the author, the singer, the guitarist, the drummer, etc.
    As an example, this should allow a user to find all of the songs that Paul McCartney has made contributions to, whether it was as a member of The Beatles
    or as a member of Wings.

    There needs to be information on what contribution each of these contributors has made for each song. As an example, David Bowie would have contributed
    as a writer, a singer, and likely a guitarist in most of his songs. There are, however, songs that he did not perform, but only wrote, like “All the Young
    Dudes”, which he wrote, but which was initially performed by a band called “Mott the Hoople”.

    Each song will have at least one karaoke file, or it wouldn’t be present on the list (because the karaoke presentation software wouldn’t have anything to play),
    but each song may possibly have many karaoke files, one for each of several possible versions. Each of these files will have a unique identifier. Since it may
    be important to the karaoke singer which version they are to perform, the version should also be a part of the information used when a user signs up in one
    of the queues to sing a song.

    The karaoke file is the actual file used by the karaoke player to play the music and display the lyrics for the song. You are not expected to actually handle
    playing the karaoke files, but these are filenames and no two songs will share the same karaoke file.
    As an example of multiple versions of a file, think of a duet. There may be a version that is arranged so that both partners get to sing, as well as a version
    for each of the parts, with the other singer’s part dubbed in (in case a singer wants to sing one part and doesn’t have a partner). No two versions of a song
    will use the same karaoke file.

Signing up to sing

    Upon choosing a version of a song, the user should be able to enter their request to sing a their chosen song into one of two queues that are stored in such a
    way that they can be examined separately.
    The first queue is a free for all, first come, first served queue that can be entered without charge.
    The other queue is an accelerated, priority queue, where the user can pay money to potentially have his song played earlier.
    Your application needs to allow people to sign up in the queues for singing. The DJ will be in charge of deciding which user/singer gets to sing their song
    next at any given time. The contents of each of the queues should be shown to him separately to help him make those decisions.
    DJ interface

    You are also tasked with designing the DJ interface. This interface should show both queues separately (DO NOT MERGE THEM), but on the page,
    including relevant information about both the user that is singed up to sing and the version of the song they signed up in the queue to sing. This information
    should include the user who requested the song, its title, the name of the band that performed it, and the special karaoke file ID associated with the version
    of the song that was selected.

Web Interface Requirements

    The interface for a user signing up to sing must be separate from the DJ interface.
    When searching for a songs, it is possible that there may be many rows of results returned. When this occurs, the user should be able to click on a table’s
    column heading to sort the results based on the data value represented by that column. The first click will sort the table in ascending order based on that
    column, then the next will sort in descending order, then back to ascending again, etc. This problem can be solved with PHP, but there are also other ways
    of handling it if you’d like to look into other, more dynamic options.

    The free queue should be sorted based on the time the user signed up; first in, first out. The accelerated queue should be able to be sorted in either time order
    or by the amount paid. Make sure to implement some mechanism to switch the sort order. The DJ needs to be able to see who is in each queue through his
    side of the application interface.

DO NOT implement a login system for your application. You will lose points if you do. This is for two reasons:
    ▶ Properly handling authentication is complicated and I don’t want you to get a false sense of confidence from doing it the naïve way and thinking it’s
       right.
    ▶ It makes grading the application harder. Several groups in the past have made logging on necessary to access their interface and forgotten to provide
       the credentials needed to access the portions of the pages that need to be checked for requirements.
DO NOT store any real payment information in your database


URL: https://students.cs.niu.edu/~z1999005/karaokeBar_home.php
