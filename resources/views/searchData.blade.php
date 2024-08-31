<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include custom JavaScript -->
    <script src="{{ asset('js/search.js') }}" defer></script>
    <!-- Styles -->
    <style>
        .antialiased {
            background-color: #EEE;
        }
        .searchContainer {
            display: flex;
            flex-direction: column;
            margin: auto;
        }
        #search-results {
            list-style-type: none;
            padding: 0;
            margin-top: 10px;
            width: 51%;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-height: 200px;
            overflow-y: auto;
            position: relative; /* Ensure that loader is positioned relative to this container */
            z-index: 1000;
            background: white;
        }
        #search-results li {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }
        #search-results li:hover {
            background-color: #f0f0f0;
        }
        #search, h1 {
            width: 50%;
            margin: auto;
        }
        h1 {
            margin-top: 5%;
        }
        #search {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #EEE;
            outline: none;
            font-size: 16px;
            transition: 0.3s ease-in-out;
            margin-top: 10px;
        }
        #loader {
            display: none; /* Hidden by default */
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -100%);
            font-size: 16px;
            color: #666;
        }
    </style>
</head>

<body class="antialiased">

    <div class="searchContainer">
        <h1>Search Items</h1>
        <input type="text" id="search" name="search" placeholder="Search items..." autocomplete="off">
        <ul id="search-results">
             <!-- Loader element -->
        </ul>
        <div id="loader">Loading...</div>
    </div>
</body>

</html>
