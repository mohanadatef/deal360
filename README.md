file name
-*-*-*-*-
helper -> function use in all project many time
composer view -> function use in all view many time
traits -> function global use in many place in project and make same think but different data
repository -> all function call database or model
interface -> all function static use in repository
resources -> use in response front or mobile to return some data all time 
request -> all file Validator all request 
----------------------------------------------------------------------------------------------------------
app
***
admin -> any think about dashboard only
api -> any think about mobile or front
----------------------------------------------------------------------------------------------------------
route
*****
admin -> all url about dashboard
api -> all url about mobile or front
super admin -> all url about database or migration or cache
web -> all url about list in dashboard
wordpress -> all url about export data from wordpress deal360
----------------------------------------------------------------------------------------------------------
database
********
seeder -> some data will use in database # must found it #
migration -> all table in database
----------------------------------------------------------------------------------------------------------
public
******
image -> all image in site
vendor -> some file about js validation package
AdminLTE -> all file about template dashboard
----------------------------------------------------------------------------------------------------------
resources
*********
vendor -> some file about js validation package
admin -> all view for dashboard
auth -> login page
emails -> template all mail use in project
errors -> all view for error
includes -> admin -> base page in template dashboard
            admin -> model -> base model use in ( soft delete )
            admin -> model -> function use in ajax to create / edit / soft delete / change status
----------------------------------------------------------------------------------------------------------
project ( model or category )
*****************************
acl -> any think about ( all type for user ) or permission or role or login or register
core data -> any think about data must found in project example ( language or country or status or etc.. )
property -> any think about property
setting -> any think about static data in project
----------------------------------------------------------------------------------------------------------
for install project 
*******************
pull code form github
create database
change .env
run migration 
run seeder but if you not need wordpress data make commit in seeder for code wordpress
Done