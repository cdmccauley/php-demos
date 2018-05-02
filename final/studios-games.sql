USE gitgudgames;

INSERT INTO game_studios (studio_name)
VALUES ('AAA Game Studio');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_cover)
VALUES (1, 'AAA Title 1', 39.99, 'Hyperbole to the max! This game has almost no substance!', 'aaatitle1.png');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_cover)
VALUES (1, 'AAA Title 2', 49.99, 'The sequel to AAA Title 1! This game has less substance than the original!', 'aaatitle2.png');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_cover)
VALUES (1, 'AAA Title 3', 59.99, 'The prequel to AAA Title 1! Now you have the option to pay-to-win!', 'aaatitle3.png');

INSERT INTO game_studios (studio_name)
VALUES ('Indie Game Studio');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_cover)
VALUES (2, 'Indie Title 1', 1.99, 'Our humble beginning as a game studio.', 'indietitle1.png');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_cover)
VALUES (2, 'Indie Title 2', 2.99, 'Our passion project brought to you by the proceeds from our first title.', 'indietitle2.png');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_cover)
VALUES (2, 'Indie Title 3', 4.99, 'We just changed gaming once again and everyone loves us!', 'indietitle3.png');

INSERT INTO game_studios (studio_name)
VALUES ('Passionate Game Studio');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_cover)
VALUES (3, 'Beloved Title', 9.99, 'The game from a decade ago that everyone played and loved.', 'belovedtitle.png');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_cover)
VALUES (3, 'Free Title', 0.00, 'Get hooked on our games for free! Supported by cute outfits and cool weapons you can buy for your avatar!', 'freetitle.png');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_cover)
VALUES (3, 'Innovative Title', 49.99, 'The game that everyone is playing right now!', 'innovativetitle.png');