# level_two_test.rb
# Where it all comes together now

require_relative '../arena'

level = 2

# The templates
fighter = Player.new(8, 5, 6, 3, level)  # high low - -
rogue = Player.new(5, 4, 9, 4, level)    # - - high low
cleric = Player.new(5, 9, 3, 5, level)   # - high low -
sorcerer = Player.new(2, 7, 6, 7, level) # low - - high

fighter_monster = Monster.new(8, 5, 5, 4, level)
rogue_monster = Monster.new(7, 5, 10, 3, level)
cleric_monster = Monster.new(5, 9, 3, 5, level)
sorcerer_monster = Monster.new(2, 9, 4, 7, level)

trials = 1000

ratios = {}
ratios['fighter'] = {}
ratios['cleric'] = {}
ratios['rogue'] = {}
ratios['sorcerer'] = {}

# First the fighter monster
arena = Arena.new(fighter, fighter_monster)
ratios['fighter']['fighter_monster'] = (arena.run_test(trials, true, true))

arena.player = cleric
ratios['cleric']['fighter_monster'] = (arena.run_test(trials, false, true))

arena.player = rogue
ratios['rogue']['fighter_monster'] = (arena.run_test(trials, true, true))

arena.player = sorcerer
ratios['sorcerer']['fighter_monster'] = (arena.run_test(trials, false, true))

# Now a cleric monster
arena.player = fighter
arena.monster = cleric_monster
ratios['fighter']['cleric_ monster'] = (arena.run_test(trials, true, false))

arena.player = cleric
ratios['cleric']['cleric_ monster'] = (arena.run_test(trials, false, false))

arena.player = rogue
ratios['rogue']['cleric_ monster'] = (arena.run_test(trials, true, false))

arena.player = sorcerer
ratios['sorcerer']['cleric_ monster'] = (arena.run_test(trials, false, false))

# Rogue monster
arena.player = fighter
arena.monster = rogue_monster
ratios['fighter']['rogue_monster'] = (arena.run_test(trials, true, true))

arena.player = cleric
ratios['cleric']['rogue_monster'] = (arena.run_test(trials, false, true))

arena.player = rogue
ratios['rogue']['rogue_monster'] = (arena.run_test(trials, true, true))

arena.player = sorcerer
ratios['sorcerer']['rogue_monster'] = (arena.run_test(trials, false, true))

# Sorcerer monster
arena.player = fighter
arena.monster = sorcerer_monster
ratios['fighter']['sorcerer_monster'] = (arena.run_test(trials, true, false))

arena.player = cleric
ratios['cleric']['sorcerer_monster'] = (arena.run_test(trials, false, false))

arena.player = rogue
ratios['rogue']['sorcerer_monster'] = (arena.run_test(trials, true, false))

arena.player = sorcerer
ratios['sorcerer']['sorcerer_monster'] = (arena.run_test(trials, false, false))

# Now print the results

absolute_average = 0.0

puts 'FIGHTER'
results = ratios['fighter']
average = 0.0
results.each do |monster, ratio|
  puts monster.to_s + "\t" + ratio.to_s
  average += ratio
end
puts "average\t" + (average / 4.0).to_s
puts ''
absolute_average += (average / 4.0)

puts 'ROGUE'
results = ratios['rogue']
average = 0.0
results.each do |monster, ratio|
  puts monster.to_s + "\t" + ratio.to_s
  average += ratio
end
puts "average\t" + (average / 4.0).to_s
puts ''
absolute_average += (average / 4.0)

puts 'CLERIC'
results = ratios['cleric']
average = 0.0
results.each do |monster, ratio|
  puts monster.to_s + "\t" + ratio.to_s
  average += ratio
end
puts "average\t" + (average / 4.0).to_s
puts ''
absolute_average += (average / 4.0)

puts 'SORCERER'
results = ratios['sorcerer']
average = 0.0
results.each do |monster, ratio|
  puts monster.to_s + "\t" + ratio.to_s
  average += ratio
end
puts "average\t" + (average / 4.0).to_s
puts ''
absolute_average += (average / 4.0)

puts "absolute avg\t" + (absolute_average / 4.0).to_s