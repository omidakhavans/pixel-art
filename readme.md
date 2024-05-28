# RebelCode Task 2024

Carefully read this entire document before you start working on the task.

We designed this task to be completed in less than 4 hours. If you find yourself
overwhelmed, stuck, or confused, please reach out to us for help. This would not
negatively affect your assessment. On the contrary; we'd appreciate your honesty
and your willingness to ask for help when needed.

If you find that the task is too short or simple, we encourage you to add any
additional features that you think would highlight your strengths and skills.

# Task Details

Your task is to create a WordPress plugin that allows users to draw and display
pixel art on their website. The task consists of three parts:

## Admin Interface

The plugin should add a new admin page to the WordPress admin area. This page
will render a React app that allows users to draw and save their pixel art.

The page should show a list of buttons, each a different color. When clicked,
the color associated with that button becomes "selected". Only one color can be
selected at a time. The currently selected color should be visually indicated to
the user. Include at least 10 colors of your choosing, including `transparent`.

The pixel art is drawn in a 16x16 grid. Each "pixel" in the grid is a square that
is at least 20x20 pixels in size. When clicked, the pixel's color changes to the
currently selected color. Right-clicking a pixel copies its color to the currently
selected color. Bonus points will be awarded if your pixel grid allows the user
to click and drag to draw continuously. Do not use the Canvas API for the pixel
grid.

The page should include a "Save" button. When clicked, the pixel data is sent to
an API endpoint on the server that saves the pixel data to the database. The
interface should show visual feedback to the user indicating whether the save
operation was successful. The save button should be disabled if the pixel data
has not changed since the last save.

When the page is loaded, the grid should be populated with the pixel data that
is saved in the database. If no data is saved yet, all the pixels should be
transparent.

Lastly, make sure that your JavaScript app does not bundle React and ReactDOM.
Use the versions of these libraries that are included with WordPress.

## API

The plugin should add a new endpoint to the WordPress REST API, accessible only
by authenticated admin users. This endpoint should accept POST requests that
contain the pixel data in JSON format, and save that data to the database as a
[WordPress option](https://developer.wordpress.org/plugins/settings/options-api/).

To load the saved pixel data into the admin page, you may use a second endpoint.
This is up to you. You may choose a different method to load the data. If you
choose to use a second endpoint, make sure that it is also only accessible by
authenticated admin users.

## Block

The plugin should register a WordPress block type that renders the user's drawing
as an `<svg>`, both on the front-end of the site and inside the block editor as
a preview. Use server-side rendering (PHP) to generate the SVG markup. Do not
load any JavaScript on the front-end of the WordPress site.

The block should have a `size` attribute that controls the width and height of
the SVG, maintaining its square aspect ratio. Use a default value of 128px. The
attribute should be editable in the block editor using a field in the editor
sidebar or the block's toolbar.

If your block's JavaScript needs to be compiled, make sure to exclude React and
ReactDOM from your bundle. Use the versions of these libraries that are included
with WordPress.

# Assessment

You will be assessed on the following criteria:

- component reusability
- state management
- performance
- code organization
- validation
- error handling
- internationalization
- having minimal dependencies
- platform agnostic code
- maintainability

The visual design of the admin interface is not important. Focus on functionality,
rather than styling. We will not assess your design skills.

Similarly, you are free to use TypeScript if you wish. However, this is not
required and will not affect your assessment.

You are not required to write tests for this task. However, bonus points will
be awarded for tests that provide real value. Do not write tests for the sake
of writing tests. No tests are better than bad tests, which can negatively
affect your assessment.

We provide these assessment criteria to help you understand what we're looking
for and to help you manage your time effectively. We want to see _your_ solution,
not a perfect solution, so write code that _you_ would be proud to showcase and
happy to maintain for a long time. Do not worry if you don't have time to add
any "bonus" features. We value quality over quantity.

# Submission

Please submit your code as a zip file that includes:

- all the source code required to build and run the plugin,
- compiled JavaScript (and CSS if applicable),
- your Git history (`.git/`),
- and a README file with instructions on how to build the plugin.

We will be using your Git history to understand how you approached the task, and
how you spent your time. We expect the task to not required more than 4 hours to
complete. This is not a hard limit, but a guideline for you to manage your time
effectively. If the task is taking up too much of your time, you are likely
over-engineering it.

When you begin your task, create a new commit with the message "Start". Should
you need to pause and resume your work later, create commits with the messages
"Pause" and "Resume", respectively. You can use a dummy file/change to create
these commits.

Good luck, and have fun!
