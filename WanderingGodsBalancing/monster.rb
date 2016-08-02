class Monster

  attr_accessor :strength
  attr_accessor :constitution
  attr_accessor :dexterity
  attr_accessor :intelligence
  attr_reader :max_hp
  attr_reader :current_hp
  attr_reader :level

  def initialize(str, con, dex, intel, level = 1)
    @strength = str
    @constitution = con
    @dexterity = dex
    @intelligence = intel

    @level = level

    @max_hp = (3 * con) / 4 + str / 4 + 2 * (level - 1)
    @current_hp = @max_hp
  end

  def get_physical_to_hit
    0.1 * (3.0 * @dexterity / 7.0) + @level * 0.02 + 0.3
  end

  def get_physical_damage
    1 + rand(@strength / 2) + @level
  end

  def get_spell_to_hit
    0.1 * (3.0 * @constitution / 7.0) + @level * 0.02 + 0.3
  end

  def get_spell_damage
    1 + rand(@intelligence / 2) + @level
  end

  def get_evasiveness
    (2 * @dexterity / 3.0 + @intelligence / 3.0) * 0.02 + (@level - 1) * 0.02
  end

  def take_damage(amount)
    @current_hp -= amount
    @current_hp <= 0
  end

  def is_dead
    @current_hp <= 0
  end
end