$(document).ready(function() {
    // Bind event handlers to the search buttons
    $('#searchBtnRecipes, #searchBtnIngredients, #searchBtnCuisines, #searchBtnGroceries, #nutritionSearchBtn').click(function() {
        var activeTab = $(this).closest('.tab-pane').attr('id');
        var input = $(this).siblings('input[type="text"], select');

        // Custom validation and clearing validity
        clearAndValidateInput(activeTab, input);
    });

    // Clear custom validity when user starts to type again in any text input
    $('input[type="text"]').on('input', function() {
        this.setCustomValidity('');
    });

    // Event to clear all inputs and contents when changing tabs
    $('.nav-link').on('show.bs.tab', function(e) {
        // Clear all text inputs and reset select elements globally
        $('input[type="text"]').val('');
        $('select').prop('selectedIndex', 0); // Resets all select elements to their first option

        // Ensure to clear content from all dynamic content containers
        $('.recipeContent, .ingredientContent, .cuisineContent, .groceryContent').empty();

        // Clear all custom validation messages globally
        $('input[type="text"], select').each(function() {
            this.setCustomValidity('');
        });
    });
});

//---------------------------------------------------- Validating search bar entries ----------------------------------------------------//

function clearAndValidateInput(activeTab, input) {
    if (activeTab === 'byNutrition') {
        validateNutritionInputs(input);
    } else {
        validateOtherInputs(activeTab, input);
    }
}

function validateNutritionInputs(input) {
    var dropdown1 = $('#nutritionDropdown1').val();
    var dropdown2 = $('#nutritionDropdown2').val();
    var nutritionInput = $('#nutritionInput').val().trim();
    var valid = true;

    if (dropdown1 === "Choose...") {
        $('#nutritionDropdown1')[0].setCustomValidity("Please select a nutrient type.");
        valid = false;
    } else {
        $('#nutritionDropdown1')[0].setCustomValidity("");
    }

    if (dropdown2 === "Choose...") {
        $('#nutritionDropdown2')[0].setCustomValidity("Please select a comparison type.");
        valid = false;
    } else {
        $('#nutritionDropdown2')[0].setCustomValidity("");
    }

    if (nutritionInput === "" || isNaN(nutritionInput)) {
        $('#nutritionInput')[0].setCustomValidity("Please enter a valid number.");
        valid = false;
    } else {
        $('#nutritionInput')[0].setCustomValidity("");
    }

    if (!valid) {
        $('#nutritionDropdown1')[0].reportValidity();
        $('#nutritionDropdown2')[0].reportValidity();
        $('#nutritionInput')[0].reportValidity();
    }
}


function validateOtherInputs(activeTab, input) {
    if (!input.val().trim()) {
        switch (activeTab) {
            case 'byIngredient':
                input[0].setCustomValidity('Please enter a valid ingredient');
                break;
            case 'ingredients':
                input[0].setCustomValidity('Please enter a valid ingredient');
                break;
            case 'cuisines':
                input[0].setCustomValidity('Please enter a valid cuisine type');
                break;
            case 'groceries':
                input[0].setCustomValidity('Please enter a valid grocery item');
                break;
            default:
                input[0].setCustomValidity('Please enter a valid search term.');
                break;
        }
    } else {
        input[0].setCustomValidity(''); // Clear any existing messages if valid
    }
    input[0].reportValidity(); // Trigger the browser's validity message
}

//---------------------------------------------------- Search button click functions ----------------------------------------------------//

$('#searchBtnRecipes').click(function() {
    var ingredient = $('#searchInpRecipes').val().trim();
    if (ingredient) {
        searchRecipesByIngredient(ingredient, 20); // Assuming '10' as the desired number of results
    }
});

// Handle search by ingredients list
$('#searchBtnIngredients').click(function() {
    var ingredient = $('#searchIngredients').val().trim();
    if (ingredient) {
        searchIngredients(ingredient, 10); // Assuming you have a corresponding function
    }
});

// Handle search by cuisines
$('#searchBtnCuisines').off('click').click(function() {
    var cuisine = $('#searchCuisines').val().trim();
    if (cuisine) {
        searchCuisines(cuisine);
    }
});

// Handle search by groceries
$('#searchBtnGroceries').click(function() {
    var grocery = $('#searchGroceries').val().trim();
    if (grocery) {
        searchGroceries(grocery, 20); // Assuming you have a corresponding function
    }
});


//---------------------------------------------------- AJAX calls for all tabs ----------------------------------------------------//

// Recipe > ingredients tab
function searchRecipesByIngredient(ingredient, numberOfResults) {
    let searchResultsContainer = $('#recipes .recipeContent');

    $.ajax({
        url: 'vendors/php/recipeByIngredient.php',
        type: 'GET',
        data: {
            foodIngredient: ingredient,
            numberOfResults: numberOfResults
        },
        dataType: 'json',
        success: function(response) {
            searchResultsContainer.empty();

            if (response && response.data && Array.isArray(response.data) && response.data.length > 0) {
                response.data.sort((a, b) => a.title.localeCompare(b.title)); // Sort recipes by title

                const tableHtml = $('<table class="table"><thead><tr><th>No.</th><th>Recipe Name</th><th>Image</th></tr></thead><tbody></tbody></table>');
                const tbody = tableHtml.find('tbody');

                response.data.forEach((recipe, index) => {
                    const imageUrl = recipe.image || 'path/to/default/image.jpg';
                    const rowHtml = $(`
                        <tr class="clickable-row" data-recipe-id="${recipe.id}" data-recipe-title="${recipe.title}" data-recipe-image="${imageUrl}" data-recipe-original="${recipe.original || 'No original information available.'}">
                            <td>${index + 1}</td>
                            <td>${recipe.title}</td>
                            <td><img src="${imageUrl}" style="width: 75px; height: 75px; object-fit: cover;"></td>
                        </tr>`);
                    tbody.append(rowHtml);
                });

                searchResultsContainer.append(tableHtml);
            } else {
                searchResultsContainer.html('<p>No recipes found. Please try a different ingredient.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            searchResultsContainer.html(`<p>Error processing your request: ${error}</p>`);
        }
    });
}

$(document).on('click', '.clickable-row', function() {
    let recipeId = $(this).data('recipe-id');
    let recipeTitle = $(this).data('recipe-title');
    let recipeImage = $(this).data('recipe-image');
    let recipeOriginal = $(this).data('recipe-original');

    // Split the original ingredients string into an array, assuming it's a comma-separated list
    let ingredients = recipeOriginal.split(", ");

    // Function to capitalize the first letter if it's alphabetic
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Generate HTML for the ingredients list
    let ingredientsHtml = ingredients.map((ingredient, index) => {
        let formattedIngredient = /^[a-zA-Z]/.test(ingredient) ? capitalizeFirstLetter(ingredient) : ingredient;
        return `<tr>${index === 0 ? `<td rowspan="${ingredients.length}" class="ingredient-label"><strong>Ingredients:</strong></td>` : ""}<td>${formattedIngredient}</td></tr>`;
    }).join("");

    // Set modal content
    $('#recipeModalLabel').text(recipeTitle);
    $('#recipeImage').attr('src', recipeImage);
    $('#recipeInstruction').html(`<table class="table"><tbody>${ingredientsHtml}</tbody></table>`); // Use a table to format the ingredients list

    // Adjust the width of the first column based on its content
    adjustColumnWidth();

    // Show modal
    $('#recipeModal').modal('show');
});

function adjustColumnWidth() {
    // Create a temporary element to measure text width
    let tempLabel = $('<span>').text('Ingredients:').appendTo('body').css({
        'font-weight': 'bold',
        'visibility': 'hidden',
        'white-space': 'nowrap'
    });

    // Apply measured width plus a little padding
    $('.ingredient-label').width(tempLabel.width() + 10); // Adjust padding as needed
    $('.ingredient-empty-cell').css('border-right', 'none'); // Merge visually with the second column

    // Remove the temporary element
    tempLabel.remove();
}

// Ingredients tab
function searchIngredients(query) {
    $.ajax({
        url: 'vendors/php/searchIngredient.php', // Ensure this is the correct path
        type: 'GET',
        data: { searchIngredient: query },
        dataType: 'json',
        success: function(response) {
            var searchResultsContainer = $('#ingredients .ingredientContent'); // Target the designated results container
            var inputElement = $('#searchIngredients')[0]; // Use the specific input element ID

            searchResultsContainer.empty(); // Clear previous results

            if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                // Sort ingredients by name alphabetically
                response.data.sort(function(a, b) {
                    return a.name.localeCompare(b.name);
                });

                var tableHtml = $('<table class="table"><thead><tr><th>No.</th><th>Ingredient Name</th><th>Image</th></tr></thead><tbody></tbody></table>');
                var tbody = tableHtml.find('tbody');

                response.data.forEach(function(ingredient, index) {
                    var capitalizedIngredientName = ingredient.name.charAt(0).toUpperCase() + ingredient.name.slice(1).toLowerCase();
                    var imageUrl = ingredient.image || 'path/to/default/image.jpg'; // Use a default image if none is provided
                    var rowHtml = $(`<tr style="opacity: 0;" class="clickable-row" data-id="${ingredient.id}">
                                      <td>${index + 1}</td>
                                      <td>${capitalizedIngredientName}</td>
                                      <td><img src="${imageUrl}" style="width: 75px; height: 75px; object-fit: cover;"></td>
                                    </tr>`);

                    // Append the row to the tbody element
                    rowHtml.appendTo(tbody)
                           .delay(index * 10) // Delay based on index to create staggered appearance
                           .animate({ opacity: 1 }, 250); // Animate to full opacity over 250ms
                });

                searchResultsContainer.append(tableHtml); // Append the complete table with animated rows to the container
                inputElement.setCustomValidity(''); // Clear any previous validation messages
            } else {
                // No results found, don't show the table, just show the custom validity message
                inputElement.setCustomValidity(query + ' does not match any ingredients. Please enter a valid ingredient.');
                inputElement.reportValidity();
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            searchResultsContainer.html(`<p>Error processing your request: ${error}</p>`);
            inputElement.setCustomValidity('An error occurred. Please try again.');
            inputElement.reportValidity();
        }
    }).fail(function() {
        inputElement.setCustomValidity('An error occurred. Please try again.');
        inputElement.reportValidity();
    });
}

// Recipe > nutrition tab
$('#nutritionSearchBtn').click(function() {
    var nutrientType = $('#nutritionDropdown1').val();
    var comparisonType = $('#nutritionDropdown2').val();
    var nutritionValue = $('#nutritionInput').val().trim();

    // Determine which PHP file to call based on selections
    var apiEndpoint = determineAPIEndpoint(nutrientType, comparisonType);

    searchByNutrition(apiEndpoint, nutritionValue);
});

function determineAPIEndpoint(nutrientType, comparisonType) {
    var endpointMap = {
        '1': { // Carbohydrates
            '1': 'vendors/php/minimumCarbs.php', // Greater than
            '2': 'vendors/php/maximumCarbs.php'  // Less than
        },
        '2': { // Protein
            '1': 'vendors/php/minimumProtein.php', // Greater than
            '2': 'vendors/php/maximumProtein.php'  // Less than
        },
        '3': { // Fats
            '1': 'vendors/php/minimumFats.php', // Greater than
            '2': 'vendors/php/maximumFats.php'  // Less than
        },
        '4': { // Calories
            '1': 'vendors/php/minimumCalories.php', // Greater than
            '2': 'vendors/php/maximumCalories.php'  // Less than
        }
    };
    return endpointMap[nutrientType] ? endpointMap[nutrientType][comparisonType] : null;
}

function searchByNutrition(apiEndpoint, value) {
    $.ajax({
        url: apiEndpoint,
        type: 'GET',
        data: {
            nutritionInput: value
        },
        dataType: 'json',
        success: function(response) {
            var resultsContainer = $('.recipeContent');
            var inputElement = $('#nutritionInput')[0]; // Assuming you have a specific input field for nutrition values

            resultsContainer.empty(); // Clear previous results

            if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                response.data.sort(function(a, b) {
                    return a.title.localeCompare(b.title);
                });

                var tableHtml = $('<table class="table"><thead><tr><th>No.</th><th>Recipe Name</th><th>Image</th></tr></thead><tbody></tbody></table>');
                var tbody = tableHtml.find('tbody');

                response.data.forEach(function(recipe, index) {
                    var imageUrl = recipe.image || 'path/to/default/image.jpg';
                    var rowHtml = $(`<tr class="clickable-row" data-recipe-id="${recipe.id}" data-recipe-title="${recipe.title}" data-recipe-image="${imageUrl}" data-calories="${recipe.calories}" data-carbs="${recipe.carbs}" data-fat="${recipe.fat}" data-protein="${recipe.protein}">
                                      <td>${index + 1}</td>
                                      <td>${recipe.title.charAt(0).toUpperCase() + recipe.title.slice(1).toLowerCase()}</td>
                                      <td><img src="${imageUrl}" style="width: 75px; height: 75px; object-fit: cover;"></td>
                                    </tr>`);

                    rowHtml.appendTo(tbody).animate({ opacity: 1 }, 250);
                });

                resultsContainer.append(tableHtml);
                inputElement.setCustomValidity('');

                // Add click event listener to each row
                $('.clickable-row').on('click', function() {
                    displayModal($(this));
                });
            } else {
                inputElement.setCustomValidity(value + ' does not match any recipes with the specified nutrition criteria.');
                inputElement.reportValidity();
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            resultsContainer.html(`<p>Error fetching data. Please try again.</p>`);
            inputElement.setCustomValidity('An error occurred. Please try again.');
            inputElement.reportValidity();
        }
    }).fail(function() {
        inputElement.setCustomValidity('An error occurred. Please try again.');
        inputElement.reportValidity();
    });
}

function displayModal(row) {
    var recipeTitle = row.data('recipe-title');
    var recipeImage = row.data('recipe-image');
    var calories = row.data('calories');
    var carbs = row.data('carbs');
    var fat = row.data('fat');
    var protein = row.data('protein');

    // Update modal title and image
    $('#nutritionModalLabel').text(recipeTitle);
    $('#nutritionImage').attr('src', recipeImage);

    // Prepare HTML content for nutritional information
    var nutritionHtml = `
        <table class="table">
            <thead>
                <tr>
                    <th>Nutrient</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Calories</td><td>${calories}kcal</td></tr>
                <tr><td>Carbohydrates</td><td>${carbs}</td></tr>
                <tr><td>Fat</td><td>${fat}</td></tr>
                <tr><td>Protein</td><td>${protein}</td></tr>
            </tbody>
        </table>
    `;

    // Add nutritional information to the modal's designated area
    $('#nutritionDetails').html(nutritionHtml);

    // Show the modal
    $('#nutritionModal').modal('show');
}

// Cuisines tab
$('#searchBtnCuisines').click(function() {
    var cuisineQuery = $('#searchCuisines').val().trim(); // Get the value from the input field

    if (cuisineQuery) {
        searchCuisines(cuisineQuery); // Call the function to search cuisines if the query is not empty
    } else {
        $('#searchCuisines')[0].setCustomValidity('Please enter a cuisine to search.'); // Set custom validity for empty input
        $('#searchCuisines')[0].reportValidity(); // Display the custom validity message
    }
});

function searchCuisines(cuisine) {
    $.ajax({
        url: 'vendors/php/searchCuisine.php', // Confirm this is the correct path
        type: 'GET',
        data: { searchCuisines: cuisine },
        dataType: 'json',
        success: function(response) {
            var resultsContainer = $('#cuisinesResults .cuisineContent');
            resultsContainer.empty(); // Clear previous results

            if (response.data && response.data.results && response.data.results.length > 0) {
                var tableHtml = $('<table class="table"><thead><tr><th>No.</th><th>Cuisine Name</th><th>Image</th></tr></thead><tbody></tbody></table>');
                var tbody = tableHtml.find('tbody');

                response.data.results.forEach(function(cuisine, index) {
                    var imageUrl = cuisine.image || 'path/to/default/image.jpg';
                    var rowHtml = $(`<tr style="opacity: 0;" class="clickable-row" data-cuisine-id="${cuisine.id}">
                                      <td>${index + 1}</td>
                                      <td>${cuisine.title}</td>
                                      <td><img src="${imageUrl}" style="width: 100px; height: 100px; object-fit: cover;"></td>
                                    </tr>`);

                    // Append the row to the tbody element
                    rowHtml.appendTo(tbody)
                           .delay(index * 10) // Delay based on index to create staggered appearance
                           .animate({ opacity: 1 }, 250); // Animate to full opacity over 250ms
                });

                resultsContainer.append(tableHtml); // Append the complete table with animated rows to the container
                $('#searchCuisines')[0].setCustomValidity(''); // Clear any previous validation messages
            } else {
                // No results found, don't show the table, just show the custom validity message
                $('#searchCuisines')[0].setCustomValidity(cuisine + ' does not match any cuisines. Please enter a valid cuisine.');
                $('#searchCuisines')[0].reportValidity();
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            resultsContainer.html(`<p>Error fetching cuisines. Please try again.</p>`);
            $('#searchCuisines')[0].setCustomValidity('An error occurred. Please try again.');
            $('#searchCuisines')[0].reportValidity();
        }
    }).fail(function() {
        $('#searchCuisines')[0].setCustomValidity('An error occurred. Please try again.');
        $('#searchCuisines')[0].reportValidity();
    });
}

// Groceries tab
function searchGroceries(grocery) {
    $.ajax({
        url: 'vendors/php/searchGrocery.php', // Confirm this is the correct path to the PHP script
        type: 'GET',
        data: { searchGroceries: grocery },
        dataType: 'json',
        success: function(response) {
            var resultsContainer = $('#groceriesResults .groceryContent');
            resultsContainer.empty(); // Clear previous results

            if (response.data && response.data.products && response.data.products.length > 0) {
                var tableHtml = '<table class="table"><thead><tr><th>No.</th><th>Product Name</th><th>Image</th></tr></thead><tbody>';
                response.data.products.forEach(function(product, index) {
                    var imageUrl = product.image || 'path/to/default/image.jpg';
                    tableHtml += `<tr>
                                    <td>${index + 1}</td>
                                    <td>${product.title}</td>
                                    <td><img src="${imageUrl}" style="width: 100px; height: 100px; object-fit: cover;"></td>
                                  </tr>`;
                });
                tableHtml += '</tbody></table>';
                resultsContainer.html(tableHtml); // Display the table in the container
            } else {
                resultsContainer.html('<p>No grocery items found matching your search criteria.</p>'); // Display a message if no items are found
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            resultsContainer.html(`<p>Error fetching grocery items. Please try again.</p>`);
        }
    });
}