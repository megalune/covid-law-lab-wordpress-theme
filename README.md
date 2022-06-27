# Global Health Tracking Wordpress Theme

**Learn more about the project:** https://megalune.com/covid/
**See it in action:** https://covidlawlab.org/

##Project

##Files
- index.php - displays world map; creates search filters based on wordpress categories and custom fields
- search.php - displays matching documents; if a country was selected, pulls information from the World Health Organization to display current case trends
- country-reports/get-who-data.php - script to parse and cache WHO data
- country-reports/cached-who-data.php - the cached WHO data
- map/items-for-map.php - SQL query for map data
- map/map.js - parse data for display on the map