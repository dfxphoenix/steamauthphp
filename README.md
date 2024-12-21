# Steam Auth PHP

<b>Steam Auth PHP</b> is a lightweight script designed to integrate Steam authentication into your website or application, enabling users to log in securely using their Steam accounts.

# Features

<b>Steam Account Login:</b>  
<p>Provides a simple and secure method for users to authenticate using their Steam accounts, allowing access to protected content.</p>

<b>Session Management:</b>  
<p>Automatically creates a session using the user's SteamID as the session ID, maintaining secure and reliable user authentication.</p>

<b>Profile Data Retrieval:</b>  
<p>Includes functionality to fetch and utilize Steam profile information, such as usernames, avatars, and online statuses, for a personalized user experience.</p>

<b>Customizable Integration:</b>  
<p>Offers flexibility to adapt the authentication process to your specific requirements, ensuring seamless integration into your existing PHP-based projects.</p>

<b>Lightweight and Efficient:</b>  
<p>Designed to minimize resource usage while maintaining high performance, making it suitable for any web environment.</p>

<b>Comprehensive API Integration:</b>  
<p>Leverages Steam's API for accurate and up-to-date user information, ensuring reliable data handling.</p>

<b>Secure Authentication:</b>  
<p>Implements OpenID-based authentication, providing a robust and trusted login system for your users.</p>

<b>Easy to Implement:</b>  
<p>Requires minimal setup and configuration, enabling developers to quickly integrate Steam authentication into their projects.</p>

# Use Cases

- Allowing users to log in to your gaming community website.  
- Displaying Steam profile details, such as avatars and usernames, on leaderboards or profiles.  
- Protecting sections of your site by restricting access to authenticated Steam users.  

Steam Auth PHP simplifies the process of incorporating Steam authentication, making it an essential tool for any gaming-related project or platform.

# Profile Variables

* `$steamprofile['error']` - The Steam Auth error message
* `$steamprofile['steamid']` - The user's unique SteamID
* `$steamprofile['communityvisibilitystate']` - This represents whether the profile is visible or not.
* `$steamprofile['profilestate']` - If set, indicates the user has a community profile configured (will be set to '1')
* `$steamprofile['personaname']` - Their current set profile name
* `$steamprofile['lastlogoff']` - Last time the user was online in unix time
* `$steamprofile['profileurl']` - The URL to their steam profile
* `$steamprofile['avatar']` - The image URL to the smallest size of their avatar (32px x 32px)
* `$steamprofile['avatarmedium']` - The image URL to the medium sized version of their avatar (64px x 64px)
* `$steamprofile['avatarfull']` - The image URL to the largest size of their avatar (184px x 184px)
* `$steamprofile['personastate']` - The user's current state, 1 - Online, 2 - Busy, 3 - Away, 4 - Snooze, 5 - looking to trade, 6 - looking to play
* `$steamprofile['realname']` - The user's "real" name
* `$steamprofile['primaryclanid']` - The user's primary group
* `$steamprofile['timecreated']` - When the account was created in unix time
* `$steamprofile['uptodate']` - When profile information was last updated in unix time