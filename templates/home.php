<h1><?=( array_key_exists('page_title',$content) && ! empty($content['page_title']))?$content['page_title']:null;?></h1>

<h2>Before you start</h2>
<p>Thanks for taking the time to complete this coding assignment!  This assignment has been designed to give you an opportunity to demonstrate your ability to write PHP code to solve problems.  You might find it easy, or you might find it hard.  Either is OK!  If you don't manage to complete the assignment, please just send us what you have done so far - it's not intended that you should spend more than an evening or two on this.</p>

<h2>The tasks</h2>
<p><strong>Read the complete instructions before you start.</strong>  You can do the tasks in any order - you may choose to refactor and fix the bug (tasks 3 and 4) before building the controller actions - or you may want to do it the other way round.  It's up to you.</p>
<p>Your challenge is to help build a tiny ecommerce store.  You need to create a "products" page, listing the products available, and also a way to import products into the database.  Note that there is not really a database, just a flat-file data store which exposes some database-like methods (see <code>src/ProductDataStore.php</code>).</p>
<p>Someone else from your team has already written some basic code to handle requests.  Check over what they've done so far in the <code>src</code> directory.  You need to flesh out the controller methods in <code>src/Controller.php</code>.  The methods should return a string - the <code>Application</code> class will then add some layout HTML and serve the result up to the client.</p>

<h3>1. Product importer - adminImportProducts</h3>
<p>When this controller action is accessed, the products should be read from a CSV file that is in the root directory - <code>products.csv</code> (an administrator at your company has uploaded this via FTP).  The products should be saved using the <code>ProductDataStore</code> class.  You should be able to figure out how to use this class from reading the source code and comments.  The validation code is there just to make you aware of any problems with the data you are saving - you don't need to worry about displaying validation errors (the CSV file is in the correct format). Note that calling <code>insert()</code> doesn't actually save anything until you call <code>commit()</code> - make sure to do that after you've inserted all of the products, or the data will not be saved.</p>
<p>It's up to you what to send back to the client once the products are saved - you could display a success message, or redirect to the shop, or whatever you think is appropriate.</p>

<h3>2. Products page</h3>
<p>This page should display each product with its name, price, image, and the colours that are available.  Don't worry about adding options to select a colour, or a way for users to add products to their shopping cart - orders are only taken in person at the company's headquarters, anyway.  Use whatever HTML markup you think is suitable.</p>

<h3>3. Refactoring</h3>
<p>There is some duplication in <code>Application::dispatch()</code> and <code>Controller::home()</code> - both methods have code for rendering a template. Find a way to get rid of this duplication - and make sure you don't introduce any more duplication with the code that you write for the products page.</p>

<h3>4. Better 404 errors</h3>
<p>When a page is not found (for example <a href="/?page=doesntexist" target="_blank">this page</a>), currently it results in a <code>Fatal error: Uncaught Error: Call to undefined method...</code>.  This is not ideal, it would be better to indicate to the user that the page doesn't exist.  Implement this.  There is no need to render a nice looking error page, just printing out a string "Not found" is perfectly sufficient.</p>

<h2>The UI</h2>
<p>Don't worry about how it looks.  You have a designer on your team who will make it pretty.  Just make it work!</p>