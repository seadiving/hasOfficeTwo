
            <header class="hero-banner">
                <hgroup class="block text-only">
                    <?php if ($flashes): ?>
					                            <ul id="flashes">
					                            <?php foreach ($flashes as $flash): ?>
					                                <li><?php echo $flash; ?></li>
					                            <?php endforeach; ?>
					                            </ul>
					                        <?php endif; ?>

					                        <?php require $template; ?>
					                       
                </hgroup>
            </header>

            <ul>
                                    <li class="block-wrap" data-rowspan="1" data-colspan="1">
                        <figure class="block team-block">
                            <a class="link-block" href="team/andy/index.html">
                                <img class="resize" src="/img/base/spacer.png" rel="/hasImm/concept.jpg" alt="Mickey" />
                                <noscript><img src="/hasImm/concept.jpg" alt="Mickey" /></noscript>
                            </a>
                            <h3><a href="team/andy/index.html">Mickey Mouse</a></h3>
                            <p>Managing Director</p>
                        </figure>
                    </li>
                                    <!--<li class="block-wrap" data-rowspan="1" data-colspan="1">
                        <figure class="block team-block">
                            <a class="link-block" href="team/jim/index.html">
                                <img class="resize" src="/img/base/spacer.png" rel="/hasImm/concept.jpg" alt="Jim Ramsden" />
                                <noscript><img src="/img/team/jim.jpg" alt="Jim Ramsden" /></noscript>
                            </a>
                            <h3><a href="team/jim/index.html">Stonz Jim</a></h3>
                            <p>Creative Director</p>
                        </figure>
                    </li> -->
                    </ul>

      <!--/#titoli--> 
