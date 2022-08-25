<?php
/*English Language File*/

class language
{
	
	/*Common Start*/
    var $name='Name';
    var $customer='Customer';
    var $employee='Employee';
    var $date='Date';
    var $rowID='Row ID';
    var $field='Field';
	var $data='Data';
	var $quantityPurchased='Quantity Purchased';
	var $listOf='List Of';
	var $Create='Create';
	var $Master='Master';
	var $Add='Add';
	var $Edit='Edit';
	var $Code='Code';
	var $Description='Description';
	var $wo='w/o';//without
	/*Generic End*/
    
	
	/*Login Start*/
	var $login='Login';
    var $loginWelcomeMessage='Welcome to the Gaya Fusion System. To&nbsp; continue, please login using your username and&nbsp;password below.';
    var $username='Username';
    var $password='Password';
    var $go='Go!';
	/*Login End*/
	
		
	/*Menubar Start*/
    var $home='Home';
    var $customers='Customers';
	var $RnD='R&amp;D';
	var $Collection='Collection';
	var $Costing='Costing';
	var $Administration='Administration';
    var $config='Config';
    var $CreatedBy='Created By';
    var $welcome='Welcome';
    var $logout='Logout';
	/*Menubar End*/

	
	/*Home Start*/
	var $welcomeTo='Welcome to';
	var $adminHomeWelcomeMessage='Ceramic and Design System.&nbsp;You are currently logged in<br>as an administrator.<br> With administrative rights, you can go anywhere and do anything on this system.&nbsp;<br>Alternatively, you may select from the following common administrative tasks:';
    var $RndHomeWelcomeMessage='Ceramic and Design System! You are currently logged in as R&amp;D - Collection staf. To begin,<br>please select the option from the navigation menu.';
	var $CostingHomeWelcomeMessage='Ceramic and Design System! You are currently logged in as Costing staf.  To begin,<br>please select the option from the navigation menu.';
	var $AdministrationHomeWelcomeMessage='Welcome To Gaya Fusion Ceramic and Design System! You are currently logged in as Administration staf.  To begin,<br>please select the option from the navigation menu.';
    var $backupDatabase='Backup Database';
    var $processSale='Process A Sale';
    var $addRemoveManageUsers='Add, Remove or Manage Users';
    var $addRemoveManageCustomers='Add, Remove Or Manage Customers';
    var $addRemoveManageItems='Add, Remove or Manage Items for Sale';
	var $ViewRnD='View R&amp;D';
	var $ViewCosting='View Costing';
	var $ViewCollection='View Collection';
	var $ViewAdministration='View Administration';
    var $viewReports='View Reports';
    var $configureSettings='Configure Gaya Fusion System Settings';
    var $viewOnlineSupport='View Online Support';
	/*Home End*/
	
	
	/*Users Home Start*/
	var $createUser='Create a New User';
    var $manageUsers='Manage Users';	
    /*Users Home End*/
	
	
	/*Users Form Start*/
	var $addUser='Add User';
	var $usedInLogin='used in login';
    var $type='Type';
    var $admin='Admin';
    var $confirmPassword='Confirm Password';
	/*Users Form End*/


	/*Manage Users Start*/
	var $searchForUser='Search for User (By username)';
    var $searchedForUser='Searched for username';
	var $deleteUser='Delete User';
    var $updateUser='Update User';
	/*Manage Users End*/
	
	
	/*Customers Home Start*/
    var $customersWelcomeScreen='Welcome to the Customers panel!&nbsp;Here you can manage your customers database.&nbsp;You must add one customer before you can process a sale. What would you like to do?';
    var $createNewCustomer='Create A New Customer';
    var $manageCustomers='Manage Customers';
    var $customersBarcode='Customers Barcode Sheet';
	/*Customers Home End*/
    
    
 	/*Customers Form Start*/
 	var $addCustomer='Add Customer';
    var $firstName='First Name';
    var $lastName='Last Name';
    var $accountNumber='Account Number';
    var $phoneNumber='Phone Number';
    var $email='E-Mail';
    var $streetAddress='Street Address';
    var $commentsOrOther='Comments/Other';
 	/*Customers Form End*/
 	
 	
 	/*Manage Customers Start*/
 	var $updateCustomer='Update Customer';
    var $deleteCustomer='Delete Customer';
    var $searchForCustomer='Search for Customer';
    var $searchedForCustomer='Searched for customer';
	var $listOfCustomers='List of Customers';
	/*Manage Customers End*/
	
	
	/*R&D panel start*/
	var $RnDWelcomeScreen='Welcome to the R&amp;D panel.&nbsp; Here you manage R&amp;D section, create samples and components.<br>What you want to do?';
	var $ManageSamplePackaging='Manage Sample Packaging';
	var $ManageSampleOther='Manage Sample Other';
	var $ManageClay='Manage Clay';
	var $ManageCasting='Manage Casting';
	var $ManageEstruder='Manage Estruder';
	var $SalahTexture='Texture';
	var $ManageTools='Manage Tools';
	var $ManageEngobe='Manage Engobe';
	var $ManageStainOxide='Manage Stain&amp;Oxide';
	var $ManageGlaze='Manage Glaze';
	var $ManageFiringPlan='Manage Firing Plan';
	var $ManageDesignMaterial='Manage Design Material';
	var $ManageSupplier='Manage Supplier';
	var $ManageUnit='Manage Unit';
	/*R&D home end*/
	
	/*R&D form Start*/
	var $Rnd='RESEARCH &amp; DEVELOPMENT';
	var $SampleCeramic='Sample Ceramic';
	var $SamplePackaging='Sample Packaging';
	var $SampleOther='Sample Other';
	var $Clay='Clay';
	var $Casting='Casting';
	var $Estruder='Estruder';
	var $Texture='Texture';
	var $Tools='Tools';
	var $Engobe='Engobe';
	var $StainOxide='Stain&amp;Oxide';
	var $Glaze='Glaze';
	var $FiringPlan='Firing Plan';
	var $DesignMaterial='Design Material';
	var $Supplier='Supplier';
	var $Unit='Unit';
	/*R&D form end*/
	
	/*Costing Panel Start*/
	var $CostingWelcomeScreen='Welcome to the Costing panel.&nbsp; Here you manage Costing for all items.<br>What you want to do?';
	var $ClayPreparation='Clay Preparation';
	var $Wheel='Wheel';
	var $Slab='Slab';
	var $Finishing='Finishing';
	var $Glazing='Glazing';
	var $Movement='Movement';
	var $PackagingWork='Packaging Work';
	var $StandardBisque='Standard Bisque';
	var $StandardGlaze='Standard Glaze';
	var $RakuBisque='Raku Bisque';
	var $RakuGlaze='Raku Glaze';
	var $ProductiveHour='Productive Hour';
	var $TrowWorker='Trow Worker';
	var $CostBudgetPreview='Cost Budget Preview';
	var $CostPerMinute='Cost/Minute';
	var $PriceForFiring=';Price For Firing';
	var $GeneralCostControl='General Cost Control';
	/*Costing Panel end*/
	
	/*Collection Panel Start*/
	var $CollectionWelcomeScreen='Welcome to the Collection panel.&nbsp; here you create Design, Name, Category, Info/Size, Texture, Color, Material.<br> What would you like to do?';
	var $Design='Design';
	var $Name='Name';
	var $Category='Category';
	var $InfoSize='Info/Size';
	var $Color='Color';
	var $Material='Material';
	var $InGroup='In Group';
	/*Collection Panel End*/
	
	/*Administration-Manage Panel Start*/
	var $AdministrationWelcomeScreen='Welcome to the Administration panel.&nbsp; Here is a place you manage Quotations, Proforma, Production Order List, Invoice, and Packing List.<br>What would you like to do?';
	var $ManageDocument='Manage Document';
	var $CreateDocument='Create Document';
	var $ViewDocument='View Documents';
	var $Quotation='Quotation';
	var $Proforma='Proforma';
	var $ProductionOrderList='Production Order List';
	var $Invoice='Invoice';
	var $PackagingList='Packaging List';
	var $Report='Report';
	var $Ar='Account Receivable';
	var $PriceList='Price List';
	/*Administration-Manage Panel end*/
	
	/*Administration-Manage Document Form Start*/
	var $QuotationNo='Quotation No.';
	var $QuotationDate='Quotation Date';
	var $Validity='Validity';
	var $ClientOrderRef='Client Order Ref';
	var $DeliveryAddress='Delivery Address';
	var $Attn='Attn';
	var $Email='E-mail';
	var $ClientAddress='Address';
	var $ClientPhone='Phone';
	var $ClientFax='Fax';
	var $PackagingCost='Packaging Cost';
	var $Manage='Manage';
	var $DeliveryTerm='Delivery Term';
	var $DeliveryTime='Delivery Time';
	var $PaymentTerm='Payment Term';
	var $SpecialInstruction='Special Instruction';
	var $IssuedBy='Issued By';
	var $CustomerApproval='Customer Approval';
	/*Administration-Manage Document Form Start*/
	
	/*Administration-Manage Master Start*/
	var $CreateNewclient='Create New Client';
	var $Rate='Rate';
	var $Currency='Currency';
	var $Percentage='Percentage';
	var $AddressBook='Address Book';
	var $GayaAddress='Gaya Fusion Address';
	var $ClientDatabase='Client Database';
	/*Administration-Manage Master End*/
	
	/*Items Home Start*/
    var $itemsWelcomeScreen='Welcome to the Items panel.&nbsp; Here you manage Items, Brands, Categories and Suppliers.&nbsp; Before you can process a sale, you need to add at least one category, one brand, one supplier, and one item.&nbsp;<br>What would 
you like to do?';
    var $createNewItem='Create a New Item';
    var $manageItems='Manage Items';
    var $manageItems2='Manage Items NEW!';
    var $discountAnItem='Discount an item';
    var $manageDiscounts='Manage Discounts';
    var $itemsBarcode='Items Barcode Sheet';
    var $createBrand='Create a New Brand';
    var $manageBrands='Manage Brands';
    var $createCategory='Create a New Category';
    var $manageCategories='Manage Categories';
    var $createSupplier='Create a New Supplier';
    var $manageSuppliers='Manage Suppliers';
	/*Items Home End*/	
 	
 	
 	/*Items Form Start*/
 	var $itemName='Item Name';
    var $description='Description';
    var $itemNumber='Item Number';
    var $brand='Brand';
    var $category='Category';
    var $supplier='Supplier';
    var $buyingPrice='Buying Price';
    var $sellingPrice='Selling Price';
    var $tax='Tax';
    var $supplierCatalogue='Supplier Catalogue #';
    var $quantityStock='Quantity in Stock';
    var $reorderLevel='Reorder Level';
 	var $users='Users';
    var $itemsInBoldRequired='Items in bold are required';
    var $update='Update';
    var $delete='Delete';
    var $addItem='Add Item';
    var $brandsCategoriesSupplierError='You must create brands, categories, and suppliers before creating an item<br><a href=index.php>Back to Items Main</a>';
    var $finalSellingPricePerUnit='Final Selling Price per Unit';
	/*Items Form End*/
	
	
	/*Manage Items Start*/
	var $updateItem='Update Item';
    var $deleteItem='Delete Item';
    var $searchForItem='Search for Item (By Item Name)';
    var $searchForItemBy='Search for Item';
    var $searchBy='by';
    var $searchedForItem='Searched for item';
    var $listOfItems='List Of Items';
    var $showOutOfStock='Show Out of Stock Items';
    var $outOfStock='Out of Stock Items';
    var $showReorder='Show Items that need to be reordered';
    var $reorder='Items that need to be reordered';
	/*Manage Items End*/
	
    /*Discount From Start*/
    var $addDiscount='Add Discount';
    var $percentOff='Percent Off';
    var $comment='Comment';
    /*Discount From End*/
    
    
    /*Manage Discounts Start*/
    var $searchForDiscount='Search for discount (By percent off)';
    var $searchedForDiscount='Searched for discount';
    var $listOfDiscounts='List Of Discounts';
    var $updateDiscount='Update Discount';
    var $deleteDiscount='Delete Discount';
    /*Manage Discounts End*/
    
    /*Brands Form Start*/
    var $brandName='Brand Name';
    var $addBrand='Add Brand';
	/*Brands Form End*/
    
    
    /*Manage Brands Start*/
    var $searchForBrand='Search for brand (By brand name)';
    var $searchedForBrand='Searched for brand';
    var $listOfBrands='List Of Brands';
    var $updateBrand='Update Brand';
    var $deleteBrand='Delete Brand';
	/*Manage Brands End*/
    
    
    /*Categories Form Start*/
    var $categoryName='Category Name';
    var $addCategory='Add Category';
	/*Categories Form End*/


    /*Manage Categories Start*/
	var $searchForCategory='Search for category (By category name)';
    var $searchedForCategory='Searched for category';
    var $listOfCategories='List of categories';
    var $updateCategory='Update Category';
    var $deleteCategory='Delete Category';
    /*Manage Categories End*/
    
    
    /*Suppliers Form Start*/
    var $supplierName='Supplier Name';
    var $address='Address';
    var $contact='Contact';
    var $other='Other';
	/*Suppliers Form End*/


    /*Manage Suppliers Start*/
    var $listOfSuppliers='List Of Suppliers';
    var $searchForSupplier='Search for supplier (By supplier name)';
    var $searchedForSupplier='Searched for supplier';
    var $addSupplier='Add Supplier';
    var $updateSupplier='Update Supplier';
    var $deleteSupplier='Delete Supplier';
    /*Manage Suppliers End*/


	/*Reports Home Start*/
	var $reportsWelcomeMessage='Welcome to the Reports panel!&nbsp; Here you can view reports based on sales.&nbsp;<br>What would you like to do?';
    var $allCustomersReport='All_Customers_Report';
    var $allEmployeesReport='All_Employees_Report';
    var $allBrandsReport='All_Brands_Report';
    var $allCategoriesReport='All_Categories_Report';
    var $allItemsReport='All_Items_Report';
    var $allItemsReportDateRange='All_Items_Report_(DateRange)';
    var $brandReport='Brand_Report';
    var $categoryReport='Category_Report';
    var $customerReport='Customer_Report';
    var $customerReportDateRange='Customer_Report_(DateRange)';
    var $dailyReport='Daily_Report';
    var $dateRangeReport='Date_Range_Report';
    var $employeeReport='Employee_Report';
    var $itemReport='Item_Report';
    var $itemReportDateRange='Item_Report_(DateRange)';
    var $profitReport='Profit_Report';
    var $taxReport='Tax_Report';
    var $notFound='was not found';
	/*Reports Home End*/
	
	
	/*Input Needed Form Start*/
	var $inputNeeded='Input needed for';
    var $dateRange='Date Range';
    var $today='Today';
    var $yesterday='Yesterday';
    var $last7days='Last 7 Days';
    var $lastMonth='Last Month';
    var $thisMonth='This Month';
    var $thisYear='This Year';
    var $allTime='All Time';
    var $findBrand='Find Brand';
    var $selectBrand='Select Brand';
    var $findCategory='Find Category';
    var $selectCategory='Select Category';
    var $findCustomer='Find Customer';
    var $selectCustomer='Select Customer';
    var $findEmployee='Find Employee';
    var $selectEmployee='Select Employee';
    var $findItem='Find Item';
    var $selectItem='Select Item';
    var $selectTax='Select Tax';
	/*Input Needed Form End*/
    
    
    /*"All" Reports Start*/
		
		/*All Customers Report Start*/
		var $itemsPurchased='Items Purchased';
   		var $moneySpentBeforeTax='Money Spent before tax';
    	var $moneySpentAfterTax='Money Spent after tax';
		var $totalItemsPurchased='Total Items Purchased';
		/*All Customers Report End*/
		
		/*All Brands Report Start*/
		var $totalsForBrands='Totals For Brands';
		/*All Brands Report End*/

		/*All Categories Report Start*/
		var $totalsForCategories='Totals For Categories';
		/*All Categories Report End*/

		/*All Employees Report Start*/
		var $totalItemsSold='Total Items Sold';
    	var $moneySoldBeforeTax='Money Sold before tax';
		var $moneySoldAfterTax='Money Sold after tax';
		/*All Employees Report End*/
		
		/*All Items Report Start*/
		var $numberPurchased='Number Purchased';
   		var $subTotalForItem='Sub Total For Item';
        var $totalForItem='Total For Item';
		/*All Items Report End*/
	
	/*"All" Reports End*/
	
	
	/*Other Reports Start*/
	var $paidWith='Paid With';
    var $soldBy='Sold By';
    var $saleDetails='Sale details';
    var $saleSubTotal='Sale Sub Total';
    var $saleTotalCost='Sale Total Cost';
    var $showSaleDetails='Show Sale Details';
    var $listOfSaleBy='List of Sales by';
    var $listOfSalesFor='List Of Sales for';
    var $listOfSalesBetween='List Of Sales<br>between dates';
    var $and='and';
    var $between='between';
    var $totalWithOutTax='Total (w/o Tax)';
    var $totalWithTax='Total (w/ Tax)';
	var $fromMonth='From Month';
    var $day='Day';
    var $year='Year';
    var $toMonth='To Month';
    var $totalAmountSoldWithOutTax='Total Amount Sold (w/o tax)';
    var $profit='Profit';
    var $totalAmountSold='Total Amount Sold';
    var $totalProfit='Total Profit';
    var $totalsShownBetween='Totals shown for sales between';
    var $totalItemCost='Total Item Cost';
	/*Other Reports End*/
		
		
	/*Sales Home Start*/
	var $salesWelcomeMessage='Welcome to the Sales panel!&nbsp; Here you can enter sales and manage them.&nbsp;What would you like to do?';
    var $startSale='Start A New Sale';
    var $manageSales='Manage Sales';
	/*Sales Home End*/
	
	
	/*Sale Interface Start*/
    var $yourShoppingCartIsEmpty='Your Shopping Cart is Empty';
    var $addToCart='Add To Cart';
    var $clearSearch='Clear Search';
    var $saleComment='Sale Comment';
    var $addSale='Add Sale';
    var $quantity='Quantity';
    var $remove='Remove';
    var $cash='Cash';
	var $check='Check';
	var $credit='Credit';
	var $giftCertificate='Gift Certificate';
	var $account='Account';
	var $mustSelectCustomer='You must select a customer';
	var $newSale='New Sale';
	var $clearSale='Clear Sale';
	var $newSaleBarcode='New Sale using barcode scanner';
	var $scanInCustomer='Scan in customer';
	var $scanInItem='Scan in item';
	var $shoppingCart='Shopping Cart';
	var $customerID='Customer ID';
	var $itemID='Item ID';
	var $amtTendered='Amt Tendered'; 
    var $amtChange='CHANGE'; 
    var $outOfStockWarn='OUT OF STOCK';
    var $globalSaleDiscount='Global Sale Discount (%)';
	/*Sale Interface End*/
	
	
	/*Sale Receipt Start*/
	var $orderBy='Order by';
	var $itemOrdered='Item Ordered';
	var $extendedPrice='Extended Price';
	var $saleID='Sale ID';
	var $orderFor='Order For';
	/*Sale Receipt End*/


	/*Manage Sales Start*/
	var $searchForSale='Search for Sale (By Sale ID Range)';
	var $searchedForSales='Searched for sales between';
	var $highID='high id';
	var $lowID='low id';
	var $incorrectSearchFormat='Incorect Search Format, please try again';
	var $updateRowID='Update row id';
	var $updateSaleID='Update Sale id';
	var $itemsInSale='Items In Sale';
	var $itemTotalCost='Item Total Cost';
	var $updateSale='Update Sale';
	var $deleteEntireSale='Delete Entire Sale';
	var $customerName='Customer Name';
	var $unitPrice='Unit Price';
	/*Manage Sales End*/
	
	
	/*Config Start*/
	var $configurationWelcomeMessage='Welcome!&nbsp; This is the Configuration panel for Gaya Fusion System.&nbsp; Here you can modify company information, themes, and other options.&nbsp;Fields in bold are required.';
    var $companyName='Company Name';
    var $fax='Fax';
    var $website='Website';
    var $theme='Theme';
    var $taxRate='Tax Rate';
    var $inPercent='in percent';
    var $currencySymbol='Currency Symbol';
    var $barCodeMode='Bar Code Mode';
    var $language='Language';
	/*Config End*/
	
	
	/*Error Messages Start*/
	var $youDoNotHaveAnyDataInThe='You do not have any data in the';
    var $attemptedSecurityBreech='Attempted Secuirty breech, you are not a possible user type.';
    var $mustBeAdmin='You must be an Admin to view this page.';
    var $mustBeReportOrAdmin='You must be a Report Viewer or Admin to view this page.';
    var $mustBeSalesClerkOrAdmin='You must be a Sales Clerk or Admin to view this page.';
    var $youMustSelectAtLeastOneItem='You must select at least one Item';
    var $refreshAndTryAgain='Refresh and try again';
	var $noActionSpecified='No action specified! No data was inserted, changed or deleted.';
	var $mustUseForm='You must use the form in order to enter data.';
	var $forgottenFields='You have forgotten one or more of the required fields';
	var $passwordsDoNotMatch='Your passwords do not match!';
	var $logoutConfirm='Are you sure you want to logout?';
	var $usernameOrPasswordIncorrect='username or password are incorrect';
	var $mustEnterNumeric='You must enter a numeric value for price, tax percent, and quantity.';
	var $moreThan200='There are more than 200 rows in the';
	var $first200Displayed='table, only the first 200 rows are displayed. Please use the search feature.';
	var $noDataInTable='You do not have any data in the';
	var $table='table';
	var $confirmDelete='Are you sure you want to delete this from the';
	var $invalidCharactor='You have entered an invalid character in one or more of the fields, please hit back and try again';
	var $didNotEnterID='You did not ender an ID';
	var $cantDeleteBrand='You can not delete this brand because at least one of your items uses it.';
	var $cantDeleteCategory='You can not delete this category because at least one of your items uses it.';
	var $cantDeleteCustomer='You can not delete this customer because he/she has purchased at least one item.';
	var $cantDeleteItem='You can not delete this item because it has been purchased at least once.';
	var $cantDeleteSupplier='You can not delete this supplier because at least one of your items uses it.';
	var $cantDeleteUserLoggedIn='You can not delete this user because you are logged in as them!';
	var $cantDeleteUserEnteredSales='You can not delete this user because he/she has entered sales.';
	var $itemWithID='Item with id';
	var $isNotValid='is not valid.';
	var $customerWithID='Customer with id';
	var $configUpdatedUnsucessfully='The configuration file was not updated, please make sure the settings.php file is writeable';
	var $problemConnectingToDB='There was a problem connecting to the database,<br> please hit back and verify your settings.';
	/*Error Messages End*/
    
    
    /*Success Messages Start*/
	var $upgradeMessage='Clicking submit will upgrade the database to version 9.0.  You must have version 7.0 or greater to upgrade Gaya Fusion System.';
	var $upgradeSuccessfullMessage='Gaya Fusion System\'s database has been successfully upgraded to version 9.0, please delete the upgrade and install folders for security purposes.';
	var $successfullyAdded='You have succesfully added this in table';
	var $successfullyUpdated='You have succesfully updated this in table';
	var $successfullyDeletedRow='You have succesfully deleted row';
	var $fromThe='from the';
	var $configUpdatedSuccessfully='The configuration file was updated successfully';
	var $installSuccessfull='The installation of Gaya Fusion System was successfull,<br> please click <a href=../login.php>here</a> to login and get started!';
	/*Success Messages End*/


	/*Installer Start*/
	var $installation='Installation';
	var $installerWelcomeMessage='Welcome to the install process for Gaya Fusion System. We\'re very excited that you\'ve<br>&nbsp;&nbsp;&nbsp;&nbsp; decided to use PHP PoS as your point of sale solution.&nbsp;To continue the installation process,<br>&nbsp;


&nbsp;&nbsp;&nbsp; please fill out the simple form below and then click  the \'Install\' button.&nbsp;';
	var $databaseServer='Database Server';
	var $databaseName='Database Name';
	var $databaseUsername='Database Username';
	var $databasePassword='Database Password';
	var $mustExist='Must Exist';
	var $defaultTaxRate='Default Tax Rate';
	var $tablePrefix='Table Prefix';
	var $numberToUseForBarcode='Property to use when scanning barcodes at sale';
	var $whenYouFirstLogIn='Important, when you first login your username is';
	var $yourPasswordIs='your password is';
	var $install='Install';
	var $serious='Serious';
	var $bigBlue='Big Blue';
	var $percent='Percent';
	/*Installer End*/
}	

?>
