# Global Health Tracking Wordpress Theme

**See it in action:** https://covidlawlab.org/

## Project
A single repository was needed to gather and share legal documents from all over the world. Collaboration needed to be coordinated between several major institutions including the United Nations Development Programme (UNDP), the World Health Organization (WHO), the Joint United Nations Programme on HIV/AIDS (UNAIDS) and the O’Neill Institute for National and Global Health Law at Georgetown University.

![world heatmap and search filters](https://megalune.com/covid/map.png)

**Learn more about the project:** https://megalune.com/covid/

## Files
- **index.php** - displays world map; creates search filters based on wordpress categories and custom fields
- **search.php** - displays matching documents; if a country was selected, pulls information from the World Health Organization to display current case trends
- **country-reports/get-who-data.php** - script to parse and cache WHO data
- **country-reports/cached-who-data.php** - the cached WHO data
- **map/items-for-map.php** - SQL query for map data
- **map/map.js** - parse data for display on the map
