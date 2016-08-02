class Player

  attr_accessor :strength
  attr_accessor :constitution
  attr_accessor :dexterity
  attr_accessor :intelligence
  attr_reader :max_hp
  attr_reader :current_hp
  attr_reader :level

  def initialize(str, con, dex, intel, level = 1)
    total = str + con + dex + intel
    raise RuntimeError, "Total of stat points must be equal to 20 + 2 * (lvl - 1); is #{total}" unless total == 20 + (level - 1) * 2

    @strength = str
    @constitution = con
    @dexterity = dex
    @intelligence = intel

    @level = level

    @max_hp = (5 * con) / 4 + str / 4 + 2 * (level - 1)
    @current_hp = @max_hp
  end

  def get_physical_to_hit
    0.1 * (3.0 * @strength / 7.0) + @level * 0.02 + 0.3
  end

  def get_physical_damage
    1 + rand(2 * @strength / 3) + @level
  end

  def get_spell_to_hit
    0.1 * (3.0 * @constitution / 7.0) + @level * 0.02 + 0.3
  end

  def get_spell_damage
    1 + rand(2 * @intelligence / 3) + @level
  end

  def get_evasiveness
    ((2.0 * @dexterity) / 3.0 + @intelligence / 3.0) * 0.0625 + (@level - 1) * 0.02
  end

  def take_damage(amount)
    @current_hp -= amount
    @current_hp <= 0
  end

  def is_dead
    @current_hp <= 0
  end

  def to_s
    "\tSTR #{@strength}
\tCON #{@constitution}
\tDEX #{@dexterity}
\tINT #{@intelligence}

\tEvasiveness #{self.get_evasiveness}
\tPhys. to-hit #{self.get_physical_to_hit}
\tPhys damage #{@strength / 2 + @level}
\tSpell to-hit #{self.get_spell_to_hit}
\tSpell damage #{@intelligence / 2 + @level}
    "
  end
end