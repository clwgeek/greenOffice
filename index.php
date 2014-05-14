<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
?> 
<html>
    <head>
        <title>Green Office Challenge</title>
        <?php
        include 'dbFunctions/headCommon.php';
        include 'writeHTML/pageTop.php';
        ?>
        <script src="js/userProfile.js"></script>
    </head>

    <body>	 	
        <?php
        navbar("home");
        jumbotron("Home Page");
        ?>
        <div class="container">
            <div class ="row-fluid">                
                <div class="span9">
                    <div class="well-large">
                        <h1>GO<span class="text-success">4IT </span> G<span class="text-success">reen </span>O<span class="text-success">ffice Challenge</span></h1>
                    </div>
                    <p>The Pellissippi State Sustainable Campus Initiative 
                        has designed the Green Office Challenge to engage faculty, 
                        staff, and students in campus sustainability. 
                        A major goal of this project is to increase awareness 
                        of the need to “Go Green.” A greener workplace creates a 
                        smaller ecological footprint, a healthier and more productive 
                        work environment, and is good news for the college financially.</p>
                    <p>Here’s how it works:<br />
                        Whether you have an individual office or a desk in a group office, 
                        you can earn recognition for your choices to support campus and personal sustainability.  
                        The program is based on a “4-Leaf” system, meaning that there are four tiers of accomplishment, 
                        each with increasing difficulty and a widening circle of networking, 
                        for creating a green office space and campus. As each leaf level is earned, 
                        faculty and staff members will be awarded a leaf for display.</p>
                    <p>The program will be facilitated by students, staff, 
                        and faculty who are committed to PSCC sustainable campus initiatives.  
                        Leaves may be earned through energy conservation, recycling, waste reduction, 
                        transportation, purchasing, and participation in events.  
                        With each item completed, one may earn points toward a leaf.  
                        Through this program, we hope not only to achieve measurable benchmarks 
                        in becoming “green,” on campus, 
                        but also to encourage behavior and life style changes beyond the campus.</p>  
                    <p>The checklists follow and may be completed online.  
                        When you have earned enough points to complete a leaf, 
                        you may submit the checklist, and your leaf will be awarded.  
                        For assistance with the checklists, please contact Karen Lively 
                        in our Sustainability Office (539-7364 or krlively@pstcc.edu), 
                        and a student, staff, or faculty member will be sent to your office to help.
                        Please begin with Leaf One and complete it before starting on the next leaf.  
                        Extra points from one leaf may be carried over to the next leaf.  
                        Note that there is a Wildcard Section at the end; 
                        points earned in that section may be put toward any leaf.</p>
                    <p>Thank you.  Together let’s GO4IT!</p>
                    <p>Susan McMahon, Christy Watson, Brenda DelGado, Larry Vincent, 
                        Heather Schroeder, Audrey Williams, Maria Rivero, Ann Kronk, 
                        and Karen Lively, Members of the Campus Sustainability Initiative</p>
                </div>         
                <div class="span3"><?php require 'userManager.php' ?></div>
            </div>
        </div>
    </body>
</html>
