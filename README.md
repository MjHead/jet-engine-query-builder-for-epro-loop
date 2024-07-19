# JetEngine Query Builder & Elementor Pro Loop

Allow to use Posts Queries from JetEngine Query Builder with Elementor Pro Loop

### Important Note
At the moment plugin works only with Posts queries from Query Builder

### How to use

1. Download, install and activate the plugin as usual WP plugin
2. Go to the query you want to use with Elementor Pro loop and copy the query ID, which you can wind in the address bar:

<img width="892" alt="image" src="https://github.com/user-attachments/assets/4e79d293-187f-4fad-9b0d-63db749f83c1">

3. Now go to the required Loop widget settings and into the Query ID option set the next string `query-builder-<ID>`, where `<ID>` is query ID you copied on the previous step:

<img width="297" alt="image" src="https://github.com/user-attachments/assets/79df75fb-66a7-4195-be70-c4360a2cd979">

You've done, now Elementor Pro Loop will use arguments from the selected query to get the posts.
