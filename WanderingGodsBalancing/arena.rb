# Simple script to test monsters against the various templates we have

require_relative 'player'
require_relative 'monster'

class Arena
  
  attr_accessor :player
  attr_accessor :monster
  
  def initialize(player, monster)
    @player = player
    @monster = monster
  end
  
  def run_test(trials, player_is_physical, monster_is_physical)
    kills = 0.0
    deaths = 0.0
    
    player_stats = [@player.strength, @player.constitution, @player.dexterity, @player.intelligence, @player.level]
    monster_stats = [@monster.strength, @monster.constitution, @monster.dexterity, @monster.intelligence, @monster.level]
    
    trials.times do

      until @player.is_dead
        # Have the monster attack first
        roll = (1 + rand(100)) * 0.01
        evasiveness = @player.get_evasiveness
        to_hit = @monster.get_physical_to_hit if monster_is_physical
        to_hit = @monster.get_spell_to_hit unless monster_is_physical
        result = to_hit - evasiveness

        if roll < result
          break if @player.take_damage(@monster.get_physical_damage)
        end

        # Then have the player attack
        roll = (1 + rand(100)) * 0.01
        evasiveness = @monster.get_evasiveness
        to_hit = @player.get_physical_to_hit if player_is_physical
        to_hit = @player.get_spell_to_hit unless player_is_physical
        result = to_hit - evasiveness

        if roll < result
          if @monster.take_damage(@player.get_physical_damage)
            kills += 1.0
            @monster = Monster.new(monster_stats[0], monster_stats[1], monster_stats[2], monster_stats[3], monster_stats[4])
          end
        end
      end

      deaths += 1.0
      @player = Player.new(player_stats[0], player_stats[1], player_stats[2], player_stats[3], player_stats[4])
    end
    
    kills / deaths
  end
end