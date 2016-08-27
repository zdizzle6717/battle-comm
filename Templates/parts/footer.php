        <!-- FOOTER -->
        <div class="footer">
            <div class="sub-footer center" id="contact">
                <div class="three_column_1 subfooter_filler">
                </div>
                <div class="three_column_1 subfooter no_margin">
                    <img src="/images/Titles/Contact_Us.png" alt=""/>
    <h4 class="left">By Phone: (909) 343-5454</h4>
                    <h4 class="left">By E-mail: Contact@Battle-Comm.com</h4>
                    <h4 class="left">Address: 555 Boutel Dr.</h4>
                    <h4 class="indent left">Someplace, CA</h4>
                </div>
                <div class="three_column_1 subfooter">
                    <img src="/images/Titles/Follow_Us.png" alt=""/>
                    <?php $pathToFile = $_SERVER['DOCUMENT_ROOT'];
					include ($pathToFile. "/Templates/includes/social-links.php"); ?>
                </div>
            </div>
            <?php include ($pathToFile. "/Templates/includes/footer.php"); ?>
            <a href="#" id="backtotop" style="display: block;">
                <span class="fa fa-angle-up"></span>
                <span class="back-to-top">Top</span>
            </a>
        </div>
    </body>
	<script><?php include ($pathToFile. "/Scripts/prefixfree.min.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/mobile-toggle.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/backtotop.js"); ?></script>
</html>